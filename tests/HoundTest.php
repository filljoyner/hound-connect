<?php

namespace filljoyner\Hound\Tests;

use GuzzleHttp\Client;
use filljoyner\Hound\Hound;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Handler\MockHandler;

/**
 * Class HoundTest
 *
 * @category Test
 * @package  filljoyner\Hound\Tests
 * @author   Philip Joyner  <@filljoyner>
 */
class HoundTest extends TestCase
{
    public function testDocumentSearch()
    {
        $mock = new MockHandler([
            new Response(200, ['Content-Type' => 'application/json'], json_encode([
                'message' => 'search results',
                'data' => [
                    'query_str' => 'hello',
                    'suggest' => null,
                    'results' => [
                        [
                            'uuid' => '3f61a945-0642-40a4-bfed-7eda4eabb4c3',
                            'title' => [
                                'text' => 'hello world',
                                'hightlight' => '<span class="match term0">Hello</span> world'
                            ],
                            'url' => '/to/my/page',
                            'text' => [
                                'text' => 'hello world',
                                'highlight' => '<span class="match term1">hello</span> world'
                            ],
                            'meta' => [
                                'terms' => [
                                    [
                                        'text' => 'hello'
                                    ],
                                    [
                                        'title' => 'hello'
                                    ]
                                ]
                            ]
                        ]
                    ],
                    'meta' => [
                        'pages' => 3,
                        'curent_page' => 1,
                        'records_per_page' => 10,
                        'total_results' => 27
                    ]
                ]
            ]))
        ]);

        $client = new Client([
            'handler' => HandlerStack::create($mock)
        ]);

        $hound = new Hound([], $client);
        $response = $hound->index('index-uuid', 'token')->search()->for('hello');
        $this->assertArrayHasKey('results', $response->json()['data']);
    }


    public function testPaginateAllDocuments()
    {
        $mock = new MockHandler([
            new Response(200, ['Content-Type' => 'application/json'], json_encode([
                'data' => [
                    [
                        'uuid' => '982f1563-f951-4a67-bb62-9de835c7a38d',
                        'local_id' => null,
                        'title' => 'hello world',
                        'url' => '/this/is/a/path',
                        'text' => 'the text goes here',
                        'meta' => null,
                        'document_url' => null,
                        'created_at' => '2020-09-07T03:10:57.000000Z',
                        'updated_at' => '2020-09-07T03:10:57.000000Z'
                    ]
                ],
                'links' => [
                    'first' => 'http://hound.pgondevops.dv/api/documents?page=1',
                    'last' => 'http://hound.pgondevops.dv/api/documents?page=2',
                    'prev' => '',
                    'next' => 'http://hound.pgondevops.dv/api/documents?page=2'
                ],
                'meta' => [
                    'current_page' => 1,
                    'from' => 1,
                    'last_page' => 2,
                    'path' => 'http://hound.pgondevops.dv/api/documents',
                    'per_page' => 15,
                    'to' => 15,
                    'total' => 28
                ]
            ]))
        ]);
        $client = new Client([
            'handler' => HandlerStack::create($mock)
        ]);

        $hound = new Hound([], $client);
        $response = $hound->index('index-uuid', 'token')->documents()->paginate();

        $this->assertTrue($response->successful());
        $this->assertTrue(!empty($response->json()['data']));
    }


    public function testDocumentCreate()
    {
        $mock = new MockHandler([
            new Response(200, ['Content-Type' => 'application/json'], json_encode([
                'data' => [
                    'uuid' => '4e9dfb09-95a1-4165-b849-ad58c041ab77',
                    'local_id' => null,
                    'title' => 'hello world',
                    'url' => '/this/is/a/path',
                    'text' => 'the text goes here',
                    'meta' => null,
                    'document_url' => null,
                    'created_at' => '2020-09-07T03:10:57.000000Z',
                    'updated_at' => '2020-09-07T03:10:57.000000Z'
                ]
            ]))
        ]);
        $client = new Client([
            'handler' => HandlerStack::create($mock)
        ]);

        $hound = new Hound([], $client);
        $response = $hound->index('index-uuid', 'token')->documents()->create([
            'title' => 'hello world',
            'url' => '/this/is/a/path',
            'text' => 'the text goes here',
        ]);

        $this->assertTrue($response->successful());
        $this->assertTrue(!empty($response->json()['data']));
    }


    public function testDocumentShow()
    {
        $mock = new MockHandler([
            new Response(200, ['Content-Type' => 'application/json'], json_encode([
                'data' => [
                    'uuid' => '4e9dfb09-95a1-4165-b849-ad58c041ab77',
                    'local_id' => null,
                    'title' => 'hello world',
                    'url' => '/this/is/a/path',
                    'text' => 'the text goes here',
                    'meta' => null,
                    'document_url' => null,
                    'created_at' => '2020-09-07T03:10:57.000000Z',
                    'updated_at' => '2020-09-07T03:10:57.000000Z'
                ]
            ]))
        ]);
        $client = new Client([
            'handler' => HandlerStack::create($mock)
        ]);

        $hound = new Hound([], $client);
        $response = $hound->index('index-uuid', 'token')->documents()->show('4e9dfb09-95a1-4165-b849-ad58c041ab77');

        $this->assertTrue($response->successful());
        $this->assertTrue(!empty($response->json()['data']));
    }


    public function testDocumentUpdate()
    {
        $mock = new MockHandler([
            new Response(200, ['Content-Type' => 'application/json'], json_encode([
                'data' => [
                    'uuid' => '4e9dfb09-95a1-4165-b849-ad58c041ab77',
                    'local_id' => null,
                    'title' => 'hello world',
                    'url' => '/this/is/a/path',
                    'text' => 'the text goes here',
                    'meta' => null,
                    'document_url' => null,
                    'created_at' => '2020-09-07T03:10:57.000000Z',
                    'updated_at' => '2020-09-07T03:10:57.000000Z'
                ]
            ]))
        ]);
        $client = new Client([
            'handler' => HandlerStack::create($mock)
        ]);

        $hound = new Hound([], $client);
        $response = $hound->index('index-uuid', 'token')->documents()->update('4e9dfb09-95a1-4165-b849-ad58c041ab77', [
            'title' => 'hello world',
            'url' => '/this/is/a/path',
            'text' => 'the text goes here',
        ]);

        $this->assertTrue($response->successful());
        $this->assertEquals('hello world', $response->json()['data']['title']);
    }


    public function testDocumentDelete()
    {
        $mock = new MockHandler([
            new Response(200, ['Content-Type' => 'application/json'], json_encode([
                'message' => 'Document queued for destruction'
            ]))
        ]);
        $client = new Client([
            'handler' => HandlerStack::create($mock)
        ]);

        $hound = new Hound([], $client);
        $response = $hound->index('index-uuid', 'token')->documents()
            ->delete('4e9dfb09-95a1-4165-b849-ad58c041ab77');

        $this->assertTrue($response->successful());
        $this->assertEquals('Document queued for destruction', $response->json()['message']);
    }
}
