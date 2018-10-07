<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Discussion::class, function (Faker $faker) {
    $fakeHeading = $faker->word;
    $fakeBoldWord = $faker->word;
    $discussionableType = $faker->randomElement(['office', 'team', 'project']);
    $discussionableId = null;
    switch ($discussionableType) {
        case 'office':
            $discussionableId = factory(App\Models\Office::class)->create()->id;
            break;
        case 'team':
            $discussionableId = factory(App\Models\Team::class)->create()->id;
            break;
        case 'project':
            $discussionableId = factory(App\Models\Project::class)->create()->id;
            break;
        default:
            throw new Exception('Wrong Taskable type');
    }

    return [
        'name'                  => $faker->sentence(6, true),
        'content'               => '<h1>' . $fakeHeading . '</h1><p>And some <strong>' . $fakeBoldWord . '</strong></p>',
        'raw_content'           => '{"ops":[{"insert":"' . $fakeHeading . '"},{"attributes":{"header":1},"insert":"\n"},{"insert":"And some "},{"attributes":{"bold":true},"insert":"' . $fakeBoldWord . '"},{"insert":"\n"}]}',
        'posted_by'             => factory(App\Models\User::class)->create()->id,
        'draft'                 => false,
        'archived'              => false,
        'discussionable_type'   => $discussionableType,
        'discussionable_id'     => $discussionableId,
        'category_id'           => factory(\App\Models\Category::class)->create()->id,
    ];
});
