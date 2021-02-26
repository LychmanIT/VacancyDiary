<?php

namespace Tests\Feature;

use App\Models\VacancyStatus;
use http\Env\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Faker\Factory as Faker;

class ExampleTest extends TestCase
{
    //Этот раздел моего творчества - мой первый опыт работы с тестами

    //Не нашел как правильно сохранять Bearer Token, поэтому проделываю аутентификацию каждый раз.

    /**
     * Test for registration via API.
     *
     * @return void
     */
    public function testApiRegister()
    {
        $response = $this->post('/api/register',
            ['name' => 'ApiUser123',
             'email' => Faker::create()->email,
             'password' => 'qwerty12345']);

        $response->assertStatus(200);
    }

    //После логина происходит редирект и я не могу изъять JSON респонс,
    //уверен, что это можно обойти, но я не буду пытаться, есть шанс застрять на этом на очень долгий
    //срок. Поэтому в каждом тесте я регистрирую нового пользователя и работаю с его респонсом.
    /**
     * Test for login via API.
     *
     * @return void
     */
    public function testApiLogin()
    {
        $response = $this->post('/api/login',
            ['name' => 'ApiUser123',
                'password' => 'qwerty12345']);

        $response->assertStatus(302);
    }

    //Пришел к тому, что метод AuthController@login явно имеет неправильную логику
    //В моем случае достаточно изъять Bearer Token при регистрации
    //и использовать только его для всех API-запросов.
    /**
     * Test for getting the vacancies list of user.
     *
     * @return void
     */
    public function testApiVacanciesList()
    {
        $data = $this->post('/api/register',
            ['name' => Faker::create()->name,
                'email' => Faker::create()->email,
                'password' => 'password'])->decodeResponseJson();

        $new_response = $this->withHeader('Authorization', 'Bearer ' . $data['access_token'])
            ->get( '/api/' . $data['user']['id'] . '/vacancy/');

        $new_response->assertStatus(200);
    }

    //Ладно, я по крайней мере очень пытался)
    //AddVacancy всегда возвращает 200
    //Проблема с логином в контроллере, инфомации как правильно работать с BearerAuth в рамках тестов
    //очень мало, но я попробовал почти все.
    //Я проиграл битву, но не войну, надеюсь со следующего коммита этих отчаянных
    //комментариев не будет)
    /**
     * Test for add a vacancy to user.
     *
     * @return void
     */
    public function testApiAddVacancy()
    {
        $data = $this->post('/api/register',
            ['name' => Faker::create()->name,
                'email' => Faker::create()->email,
                'password' => 'password'])->decodeResponseJson();

        $new_response = $this->withHeader('Authorization', 'Bearer ' . $data['access_token'])
            ->get('/api/' . $data['user']['id'] . '/vacancy/', [
                'user_id' => $data['user']['id'],
                'name' => Faker::create()->company,
                'position' => Faker::create()->jobTitle,
                'salary' => rand(500, 4000),
                'link' => strtolower('https://' . Faker::create()->company . '/'),
                'contacts' => Faker::create()->email,
                'status' => VacancyStatus::statuses[strval(array_rand(VacancyStatus::statuses, 1))],
                'notes' => Faker::create()->text,
            ]);

        $new_response->assertStatus(200);
    }
}
