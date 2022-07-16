<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('permissions')->truncate();


        // MAIN
        $manageMain = Permission::create(['name' => 'main', 'display_name_en' => 'Main', 'description_en' => 'Administrator Dashboard', 'display_name' => 'الرئيسية', 'description' => 'الرئيسية', 'route' => 'index', 'module' => 'index', 'as' => 'index', 'icon' => 'fa fa-home', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '1',]);
        $manageMain->parent_show = $manageMain->id;
        $manageMain->save();

        // POSTS
        $manageBooks = Permission::create(['name' => 'manage_books', 'display_name_en' => 'Books', 'display_name' => 'ادارة الكتب', 'route' => 'books', 'module' => 'books', 'as' => 'books.index', 'icon' => 'fas fa-newspaper', 'parent' => '0', 'parent_original' => '0', 'appear' => '1', 'ordering' => '5',]);
        $manageBooks->parent_show = $manageBooks->id;
        $manageBooks->save();
        $showBooks = Permission::create(['name' => 'show_Books', 'display_name_en' => 'Books', 'display_name' => 'ادارة الكتابات', 'route' => 'books', 'module' => 'books', 'as' => 'books.index', 'icon' => 'fas fa-newspaper', 'parent' => $manageBooks->id, 'parent_show' => $manageBooks->id, 'parent_original' => $manageBooks->id, 'appear' => '1', 'ordering' => '0',]);
        $createBooks = Permission::create(['name' => 'create_books', 'display_name' => 'انشاء كتاب', 'display_name_en' => 'Create Book', 'route' => 'books/create', 'module' => 'books', 'as' => 'books.create', 'icon' => null, 'parent' => $manageBooks->id, 'parent_show' => $manageBooks->id, 'parent_original' => $manageBooks->id, 'appear' => '0', 'ordering' => '0',]);
        $displayBooks = Permission::create(['name' => 'display_books', 'display_name' => 'عرض كتاب', 'display_name_en' => 'Show Book', 'route' => 'books/{books}', 'module' => 'books', 'as' => 'books.show', 'icon' => null, 'parent' => $manageBooks->id, 'parent_show' => $manageBooks->id, 'parent_original' => $manageBooks->id, 'appear' => '0', 'ordering' => '0',]);
        $updateBooks = Permission::create(['name' => 'update_books', 'display_name' => 'تعديا كتاب', 'display_name_en' => 'Update Book', 'route' => 'books/{books}/edit', 'module' => 'books', 'as' => 'books.edit', 'icon' => null, 'parent' => $manageBooks->id, 'parent_show' => $manageBooks->id, 'parent_original' => $manageBooks->id, 'appear' => '0', 'ordering' => '0',]);
        $destroyBooks = Permission::create(['name' => 'delete_books', 'display_name' => 'حذف الكتاب', 'display_name_en' => 'Delete Book', 'route' => 'books/{books}', 'module' => 'books', 'as' => 'books.delete', 'icon' => null, 'parent' => $manageBooks->id, 'parent_show' => $manageBooks->id, 'parent_original' => $manageBooks->id, 'appear' => '0', 'ordering' => '0',]);


        // // POSTS TAGS
        // $managePostTags = Permission::create(['name' => 'manage_post_tags', 'display_name' => 'التاغات', 'display_name_en' => 'Tags', 'route' => 'post_tags', 'module' => 'post_tags', 'as' => 'post_tags.index', 'icon' => 'fas fa-tags', 'parent' => $managePosts->id, 'parent_original' => '0', 'appear' => '0', 'ordering' => '16',]);
        // $managePostTags->parent_show = $managePostTags->id;
        // $managePostTags->save();
        // $showPostTags = Permission::create(['name' => 'show_post_tags', 'display_name' => 'التاغات', 'display_name_en' => 'Tags', 'route' => 'post_tags', 'module' => 'post_tags', 'as' => 'post_tags.index', 'icon' => 'fas fa-tags', 'parent' => $managePosts->id, 'parent_show' => $managePosts->id, 'parent_original' => $managePostTags->id, 'appear' => '1', 'ordering' => '0',]);
        // $createPostTags = Permission::create(['name' => 'create_post_tags', 'display_name' => 'انشاء تاغ', 'display_name_en' => 'Create Tag', 'route' => 'post_tags/create', 'module' => 'post_tags', 'as' => 'post_tags.create', 'icon' => null, 'parent' => $managePosts->id, 'parent_show' => $managePosts->id, 'parent_original' => $managePostTags->id, 'appear' => '0', 'ordering' => '0',]);
        // $updatePostTags = Permission::create(['name' => 'update_post_tags', 'display_name' => 'تعديل تاغ', 'display_name_en' => 'Update Tag', 'route' => 'post_tags/{post_tags}/edit', 'module' => 'post_tags', 'as' => 'post_tags.edit', 'icon' => null, 'parent' => $managePosts->id, 'parent_show' => $managePosts->id, 'parent_original' => $managePostTags->id, 'appear' => '0', 'ordering' => '0',]);
        // $destroyPostTags = Permission::create(['name' => 'delete_post_tags', 'display_name' => 'حذف تاغ', 'display_name_en' => 'Delete Tag', 'route' => 'post_tags/{post_tags}', 'module' => 'post_tags', 'as' => 'post_tags.delete', 'icon' => null, 'parent' => $managePosts->id, 'parent_show' => $managePosts->id, 'parent_original' => $managePostTags->id, 'appear' => '0', 'ordering' => '0',]);



        // EDITORS
        // SUPERVISORS
        $manageSupervisors = Permission::create(['name' => 'manage_supervisors', 'display_name' => 'المشرفون', 'display_name_en' => 'Supervisors', 'route' => 'supervisor', 'module' => 'supervisor', 'as' => 'supervisor.index', 'icon' => 'fas fa-user-shield', 'parent' => '0', 'parent_original' => '0', 'appear' => '0', 'ordering' => '700', 'sidebar_link' => '0']);
        $manageSupervisors->parent_show = $manageSupervisors->id;
        $manageSupervisors->save();
        $showSupervisors = Permission::create(['name' => 'show_supervisors', 'display_name' => 'المشرفون', 'display_name_en' => 'Supervisors', 'route' => 'supervisor', 'module' => 'supervisor', 'as' => 'supervisor.index', 'icon' => 'fas fa-user-shield', 'parent' => $manageSupervisors->id, 'parent_show' => $manageSupervisors->id, 'parent_original' => $manageSupervisors->id, 'appear' => '1', 'ordering' => '0', 'sidebar_link' => '0']);
        $createSupervisors = Permission::create(['name' => 'create_supervisors', 'display_name' => 'انشاء مشرف', 'display_name_en' => 'Create Supervisor', 'route' => 'supervisor/create', 'module' => 'supervisor', 'as' => 'supervisor.create', 'icon' => null, 'parent' => $manageSupervisors->id, 'parent_show' => $manageSupervisors->id, 'parent_original' => $manageSupervisors->id, 'appear' => '0', 'ordering' => '0', 'sidebar_link' => '0']);
        $displaySupervisors = Permission::create(['name' => 'display_supervisors', 'display_name' => 'عرض مشرف', 'display_name_en' => 'Show Supervisor', 'route' => 'supervisor/{supervisor}', 'module' => 'supervisor', 'as' => 'supervisor.show', 'icon' => null, 'parent' => $manageSupervisors->id, 'parent_show' => $manageSupervisors->id, 'parent_original' => $manageSupervisors->id, 'appear' => '0', 'ordering' => '0', 'sidebar_link' => '0']);
        $updateSupervisors = Permission::create(['name' => 'update_supervisors', 'display_name' => 'تعديل مشرف', 'display_name_en' => 'Update Supervisor', 'route' => 'supervisor/{supervisor}/edit', 'module' => 'supervisor', 'as' => 'supervisor.edit', 'icon' => null, 'parent' => $manageSupervisors->id, 'parent_show' => $manageSupervisors->id, 'parent_original' => $manageSupervisors->id, 'appear' => '0', 'ordering' => '0', 'sidebar_link' => '0']);
        $destroySupervisors = Permission::create(['name' => 'delete_supervisors', 'display_name' => 'حذف مشرف', 'display_name_en' => 'Delete Supervisor', 'route' => 'supervisor/{supervisor}', 'module' => 'supervisor', 'as' => 'supervisor.delete', 'icon' => null, 'parent' => $manageSupervisors->id, 'parent_show' => $manageSupervisors->id, 'parent_original' => $manageSupervisors->id, 'appear' => '0', 'ordering' => '0', 'sidebar_link' => '0']);
    }
}
