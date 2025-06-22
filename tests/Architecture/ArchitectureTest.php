<?php

use App\Command\CommandInterface;

test('debugs are removed')
    ->expect(['dd', 'dump', 'var_dump'])
    ->not()->toBeUsed();

test('CommandInterface is implemented')
    ->expect('App\Command')
    ->toImplement(CommandInterface::class);

test('JsonSerializable is implemented')
    ->expect('App\Entity')
    ->toImplement(\JsonSerializable::class);

test('Controllers have Controller suffix')
    ->expect('App\Controller')
    ->toEndWith('Controller');

test('application uses strict typing')
    ->expect('App')
    ->toUseStrictTypes();