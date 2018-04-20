<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->visit('/')
             ->see('Chicopee');
    }

    public function test_admin_can_login()
    {
        $adminUser = factory(App\User::class, 'admin')->create();

        $this->visit('/')
            ->type($adminUser->email, 'email')
            ->type('password', 'password')
            ->press('Sign in')
            ->seePageIs('/admin/assets');
    }

    public function test_admin_assets_page()
    {
        $adminUser = factory(App\User::class, 'admin')->create();
        $this->actingAs($adminUser);

        $this->visit('/admin/assets')
             ->seePageIs('/admin/assets');
    }

    public function test_admin_users_page()
    {
        $adminUser = factory(App\User::class, 'admin')->create();
        $this->actingAs($adminUser);

        $this->visit('/admin/users')
             ->seePageIs('/admin/users');
    }

    public function test_admin_can_create_user()
    {
        $adminUser = factory(App\User::class, 'admin')->create();
        $this->actingAs($adminUser);

        $this->expectsEvents(App\Events\UserWasCreated::class);

        $this->visit('/admin/user/create')
            ->select('admin', 'type')
            ->select('eu', 'region')
            ->type('Ned Stark', 'name')
            ->type('ned@stark.com', 'email')
            ->type('password', 'password')
            ->type('password', 'password_confirmation')
            ->press('Add User')
            ->seePageIs('/admin/users');
    }

    public function test_admin_can_edit_user()
    {
        $adminUser = factory(App\User::class, 'admin')->create();
        $this->actingAs($adminUser);

        $user = factory(App\User::class)->create();

        $this->visit('/admin/user/' . $user->id . '/edit')
            ->select('admin', 'type')
            ->press('Edit User')
            ->seePageIs('/admin/users');
    }

    public function test_admin_can_delete_user()
    {
        $adminUser = factory(App\User::class, 'admin')->create();
        $this->actingAs($adminUser);

        $user = factory(App\User::class)->create();

        $response = $this->call('DELETE', '/admin/user/' . $user->id);

        $this->assertResponseStatus(302);
        $this->assertRedirectedTo('admin/users', ['success']);
    }

    public function test_admin_cannot_delete_theirself()
    {
        $adminUser = factory(App\User::class, 'admin')->create();
        $this->actingAs($adminUser);

        $response = $this->call('DELETE', '/admin/user/' . $adminUser->id);

        $this->assertResponseStatus(302);
        $this->assertRedirectedTo('admin/users', ['error']);
    }

    public function test_user_can_login()
    {
        $user = factory(App\User::class)->create();

        $this->visit('/')
            ->type($user->email, 'email')
            ->type('password', 'password')
            ->press('Sign in')
            ->seePageIs('/assets');
    }

    public function test_admin_assets_page_for_normal_users()
    {
        $user = factory(App\User::class)->create();
        $this->actingAs($user);

        $this->visit('/admin/assets')
             ->seePageIs('/');
    }

    public function test_admin_users_page_for_normal_users()
    {
        $user = factory(App\User::class)->create();
        $this->actingAs($user);

        $this->visit('/admin/users')
             ->seePageIs('/');
    }
}
