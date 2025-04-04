<?php

test('example', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});

test('update task', function () {
    $task = Task::query()->find();
});

