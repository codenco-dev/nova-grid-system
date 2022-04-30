<?php

namespace CodencoDev\NovaGridSystem;

use Laravel\Nova\Nova;
use Laravel\Nova\Tool;
use Illuminate\Http\Request;
use Laravel\Nova\Menu\MenuSection;

class NovaGridSystem extends Tool
{
    /**
     * Perform any tasks that need to happen when the tool is booted.
     *
     * @return void
     */
    public function boot()
    {
        Nova::script('nova-grid-system', __DIR__.'/../dist/js/tool.js');
        Nova::style('nova-grid-system', __DIR__.'/../dist/css/tool.css');
    }

    public function menu(Request $request)

    {
        
    }


}
