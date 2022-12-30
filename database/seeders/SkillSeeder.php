<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $skills = [
            'php', 'laravel', 'wordpress', 'python', 'flutter','html','css' ,'spring', 'struts', 'iot', 'unity', 'typescript', '.net', 'linux', 'react native', 'DevOps', 'java', 'c', 'bootstrap', 'figma', 'tiếng anh', 'mysql', 'sqlserver', 'mvc', 'android', 'excel', 'Angular', 'AngularJS', 'Vue', 'Ember', 'ReactJS', 'Meteor', 'Mithril', 'Nodejs', 'Polymer', 'Aurelia', 'Backbone', 'CodeIgniter', 'Symfony', 'Zend', 'Phalcon', 'CakePHP', 'Yii', 'FuelPHP', 'Spring', 'Struts', 'Hibernate', 'Apache Wicket', 'GWT – Google Web Toolkit', 'Vaadin', 'Wicket', 'Vert.X', 'JSF – JavaServer Faces', 'Play!', 'Grails'
        ];
        foreach ($skills as $skill) {
            Skill::create(['name' => $skill]);
        }
    }
}
