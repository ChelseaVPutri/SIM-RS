<?php

namespace App\Livewire\PowerGrid\Themes;

use PowerComponents\LivewirePowerGrid\Themes\Tailwind;
use PowerComponents\LivewirePowerGrid\Themes\Theme;

class CustomTheme extends Tailwind
{
    public string $name = "tailwind";

    public function table(): array
    {
        return [
            'layout' => [
                'base'      => 'p-3 align-middle inline-block min-w-full w-full sm:px-6 lg:px-8',
                'div'       => 'rounded-t-lg relative border-x border-t border-pg-primary-200 dark:bg-pg-primary-700 dark:border-pg-primary-600',
                'table'     => 'min-w-full dark:!bg-primary-800',
                'container' => '-my-2 overflow-x-auto sm:-mx-3 lg:-mx-8',
                'actions'   => 'flex gap-2',
            ],

            'header' => [
                'thead'    => 'shadow-sm rounded-t-lg bg-[#26619C]',
                'tr'       => '',
                'th'       => 'font-extrabold px-3 py-3 text-left text-sm text-white tracking-wider whitespace-nowrap dark:text-pg-primary-300',
                'thAction' => '!font-bold',
            ],

            'body' => [
                'tbody'              => 'text-pg-primary-800',
                'tbodyEmpty'         => '',
                'tr'                 => 'border-b border-pg-primary-100 dark:border-pg-primary-600 hover:bg-pg-primary-50 dark:bg-pg-primary-800 dark:hover:bg-pg-primary-700',
                'td'                 => 'px-3 py-2 whitespace-nowrap dark:text-pg-primary-200',
                'tdEmpty'            => 'p-2 whitespace-nowrap dark:text-pg-primary-200',
                'tdSummarize'        => 'p-2 whitespace-nowrap dark:text-pg-primary-200 text-sm text-pg-primary-600 text-right space-y-2',
                'trSummarize'        => '',
                'tdFilters'          => '',
                'trFilters'          => '',
                'tdActionsContainer' => 'flex gap-2',
            ],
        ];
    }

    public function searchBox(): array
    {
        return [
            'input'      => 'focus:ring-primary-600 focus-within:focus:ring-primary-600 focus-within:ring-primary-600 dark:focus-within:ring-primary-600 flex items-center rounded-md ring-1 transition focus-within:ring-2 dark:ring-pg-primary-600 dark:text-pg-primary-300 text-gray-600 ring-gray-300 dark:bg-pg-primary-800 bg-white dark:placeholder-pg-primary-400 w-full rounded-md border-0 bg-transparent py-1.5 px-2 ring-0 placeholder:text-gray-400 focus:outline-none sm:text-sm sm:leading-6 w-full pl-8',
            'iconClose'  => 'text-pg-primary-400 dark:text-pg-primary-200',
            'iconSearch' => 'hidden',
        ];
    }
}