<?php

use App\Models\Slot;
use DaveJamesMiller\Breadcrumbs\BreadcrumbsGenerator;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

Breadcrumbs::register('home', function (BreadcrumbsGenerator $breadcrumbs): void {
    $breadcrumbs->push('Главная', route('home'));
});

/*
 * Slots
 */
Breadcrumbs::register('slot', function(BreadcrumbsGenerator $breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Слоты', route('slot.index'));
});
Breadcrumbs::register('slot.show', function(BreadcrumbsGenerator $breadcrumbs, Slot $slot) {
    $breadcrumbs->parent('slot');
    $breadcrumbs->push($slot->info->name, route('slot.show', $slot));
});

/*
 * User
 */
Breadcrumbs::register('user', function(BreadcrumbsGenerator $breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Profile', route('user'));
});
