<?php

namespace App\Tests\Controller;

use http\Exception\InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class IndexControllerTest extends WebTestCase
{
    public function testIndexPagination20items()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/index');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'FizzBuzz Generator');

        $form = $crawler->selectButton('Generate')->form();
        $form['fizz_buzz[from]'] = 1;
        $form['fizz_buzz[to]'] = 100;
        $form['fizz_buzz[fizzNumber]'] = 3;
        $form['fizz_buzz[buzzNumber]'] = 5;

        $crawler = $client->submit($form);

        $this->assertResponseIsSuccessful();
        $this->assertSelectorExists('table');
        $this->assertSelectorTextContains('tbody tr:last-child td:nth-child(1)', '20');
    }

    public function testFizzBuzzResultsFor3and5FirstPage()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/index');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'FizzBuzz Generator');

        $form = $crawler->selectButton('Generate')->form();
        $form['fizz_buzz[from]'] = 1;
        $form['fizz_buzz[to]'] = 100;
        $form['fizz_buzz[fizzNumber]'] = 3;
        $form['fizz_buzz[buzzNumber]'] = 5;

        $crawler = $client->submit($form);

        $this->assertResponseIsSuccessful();
        $this->assertSelectorExists('table');

        // assert for number 3
        $this->assertSelectorTextContains('tbody tr:nth-child(3) td:nth-child(1)', '3');
        $this->assertSelectorTextContains('tbody tr:nth-child(3) td:nth-child(2)', 'Fizz');

        // assert for number 5
        $this->assertSelectorTextContains('tbody tr:nth-child(5) td:nth-child(1)', '5');
        $this->assertSelectorTextContains('tbody tr:nth-child(5) td:nth-child(2)', 'Buzz');

        // assert for number 15
        $this->assertSelectorTextContains('tbody tr:nth-child(15) td:nth-child(1)', '15');
        $this->assertSelectorTextContains('tbody tr:nth-child(15) td:nth-child(2)', 'FizzBuzz');
    }

    public function testClickingPaginationLink()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/index');

        $form = $crawler->selectButton('Generate')->form();
        $form['fizz_buzz[from]'] = 1;
        $form['fizz_buzz[to]'] = 100;
        $form['fizz_buzz[fizzNumber]'] = 3;
        $form['fizz_buzz[buzzNumber]'] = 5;

        $crawler = $client->submit($form);
        $this->assertResponseIsSuccessful();

        // is the 3rd pagination link because the first link is the previous link
        $this->assertSelectorTextContains('body > div > nav > ul > li.page-item:nth-child(3) > a', '2');
        $crawler->selectLink(2)->link();
        $this->assertResponseIsSuccessful();
    }

    public function testUnexistingPage10()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/index');

        $form = $crawler->selectButton('Generate')->form();
        $form['fizz_buzz[from]'] = 1;
        $form['fizz_buzz[to]'] = 100;
        $form['fizz_buzz[fizzNumber]'] = 3;
        $form['fizz_buzz[buzzNumber]'] = 5;

        $crawler = $client->submit($form);
        $this->expectException(\InvalidArgumentException::class);
        $crawler->selectLink(10)->link();
    }
}
