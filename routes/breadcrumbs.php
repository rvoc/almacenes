<?php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Inicio', route('/'));
});
// Breadcrumbs::for('users', function ($trail) {
//     $trail->parent('home');
//     $trail->push('Usuarios', route('users'));
// });
// Breadcrumbs::for('roles', function ($trail) {
//     $trail->parent('home');
//     $trail->push('Roles', route('roles'));
// });
// Breadcrumbs::for('action_medium_term', function ($trail) {
//     $trail->parent('home');
//     $trail->push('Planificiacion', route('action_medium_term'));
// });
// Breadcrumbs::for('action_short_term_year', function ($trail,$year) {
//     $trail->parent('action_medium_term');
//     $trail->push($year->action_medium_term->code.'/'.$year->year, route('action_short_term_year',$year->id));
// });

// Breadcrumbs::for('ast_operations', function ($trail,$action_short_term) {
//     $trail->parent('action_short_term_year',$action_short_term->year);
//     $trail->push($action_short_term->code, route('ast_operations',$action_short_term->id));
// });

// Breadcrumbs::for('operation_tasks', function ($trail,$operation) {
//     $trail->parent('ast_operations',$operation->action_short_term);
//     $trail->push($operation->code, route('operation_tasks',$operation->id));
// });

// Breadcrumbs::for('specific_tasks', function ($trail,$task,$programming) {
//     $trail->parent('operation_tasks',$task->operation);
//     $trail->push($task->code.' / '.$programming->name, route('specific_task',[$task->id,$programming->id]));
// });

