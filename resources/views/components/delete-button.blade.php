<a
    {{ $attributes->merge(['class' => 'tw-inline-flex tw-items-center tw-p-2 tw-bg-red-500  tw-border tw-border-transparent tw-rounded-md tw-font-semibold tw-text-xs tw-text-white dark:tw-text-red-500 tw-uppercase tw-tracking-widest hover:tw-bg-red-400 dark:hover:tw-bg-white focus:tw-bg-red-400 dark:focus:tw-bg-white active:tw-bg-red-600 dark:active:tw-bg-red-100 focus:tw-outline-none focus:tw-ring-2 focus:tw-ring-indigo-500 focus:tw-ring-offset-2 dark:focus:tw-ring-offset-red-800 tw-transition tw-ease-in-out tw-duration-150']) }}>
    {{ $slot }}
</a>
