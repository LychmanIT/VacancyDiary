<?php

namespace Tests\Browser;

use App\Models\User;
use App\Models\Vacancy;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ExampleTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Login');
        });
    }

    /**
     * Test for auth.
     *
     * @return void
     */
    public function testAuthentication()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->visit('/')
                ->assertSee('Vacancies');
        });
    }

    /**
     * Logout test.
     *
     * @return void
     */
    public function testLogout()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->visit('/')
                ->assertSee('Vacancies')
                ->logout()
                ->assertGuest();
        });
    }

    /**
     * Test for vacancy creation.
     *
     * @return void
     */
    public function testVacancyCreation()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->visit('1/vacancy/create')
                ->assertSee('Create')
                ->type('name', 'Company')
                ->type('position', 'Otwell')
                ->type('salary', 'taylor.otwell@laravel.com')
                ->type('link', 'secret')
                ->type('contacts', 'Dreamland')
                ->type('notes', 'House Number 42')
                ->select('status')
                ->pause(2000)
                ->press('Create')
                ->pause(1000)
                ->assertSee('Vacancy was successfully added');
        });
    }

    /**
     * Test for register.
     *
     * @return void
     */
    public function testRegister()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                ->type('Name', 'newuser4321')
                ->type('Email', 'secret@gmail.com')
                ->type('Password', 'some_password123')
                ->type('password_confirmation', 'some_password123')
                ->press('Register')
                ->assertSee('Vacancies');
        });
    }

    /**
     * Test for full UI routing
     *
     * @return void
     */
    public function testTaskEdit()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->visit('1/vacancy/' . Vacancy::where(['user_id' => 1])->first()->id)
                ->assertSee('Edit')
                ->press('Edit')
                ->type('notes', 'This note was changed by test')
                ->press('Save')
                ->assertSee('Vacancy was successfully updated');
        });
    }

    /**
     * Test for disability to access another profile.
     *
     * @return void
     */
    public function testAccessToAnotherProfile()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->visit('1/vacancies')
                ->assertSee('Vacancies')
                ->visit('2/vacancies')
                ->assertSee('404');
        });
    }
}
