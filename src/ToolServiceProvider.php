<?php

namespace CodencoDev\NovaGridSystem;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Fields\Field;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Http\Requests\ResourceDetailRequest;
use Laravel\Nova\Http\Requests\UpdateResourceRequest;
use Laravel\Nova\Nova;
use CodencoDev\NovaGridSystem\Http\Middleware\Authorize;

class ToolServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishConfiguration();
        $this->bootMacros();
    }

    protected function publishConfiguration()
    {
        $this->publishes([
            __DIR__.'/../config/nova-grid-system.php' => config_path('nova-grid-system.php'),
        ], 'nova-grid-system');
    }

    protected function bootMacros()
    {
        $request = fn () => resolve(NovaRequest::class);

        $this->bootHelperMacros();
        $this->bootGlobalMacros();
        $this->bootCreatingMacros();
        $this->bootUpdatingMacros();
        $this->bootFormMacros();
        $this->bootDetailMacros();
    }

    protected function bootHelperMacros()
    {
        NovaRequest::macro('getRequestType', function () {
            $requestType = '';
            if ($this->isCreateOrAttachRequest()) {
                $requestType = 'creating';
            } elseif ($this->isUpdateOrUpdateAttachedRequest()) {
                $requestType = 'updating';
            } else {
                $requestType = 'detail';
            }
            return $requestType;
        });

        NovaRequest::macro('isActivate', function (string $meta, string $context, bool $scope = false) {
            $requestType = $this->getRequestType();

            return
                ($context == 'all'
                    || ($context=='forms' ? collect(['creating','updating'])->contains($requestType) : $requestType == $context)
                )
                && config('nova-grid-system.nova_grid_system_enabled', true)
                && config('nova-grid-system.'.$requestType.'.'.$meta, true)
                && ($scope ? $this->isActivateGlobally($meta) : true);
        });

        NovaRequest::macro('isActivateGlobally', function (string $meta) {
            $requestType = $this->getRequestType();
            return config('nova-grid-system.'.$meta.'_scope.'.$requestType, true);
        });

        Field::macro('isRequestActivate', function (string $meta, string $context, bool $scope = false) {
            return resolve(NovaRequest::class)->isActivate($meta, $context, $scope);
        });

        Field::macro('isRequestActivateGlobally', function (string $meta {
            return resolve(NovaRequest::class)->isActivate($meta);
        });

        Field::macro('withSize', function (string $size = 'w-full') {
            if ($this->isRequestActivateGlobally('stacked')) {
                $this->stacked();
            }

            return $this->withMeta(['size' => $size]);
        });
    }

    protected function bootGlobalMacros()
    {
        Field::macro('size', function ($size = 'w-full') {
            if ($this->isRequestActivate('size','all', $scope = true)) {
                $this->withSize($size);
            }
            return $this;
        });

        Field::macro('removeBottomBorder', function ($remove = true) {
            if ($this->isRequestActivate('remove_bottom_border','all', $scope = true)) {
                $this->withMeta(['removeBottomBorder' => $remove]);
            }
            return $this;
        });
    }

    protected function bootCreatingMacros()
    {
        Field::macro('sizeOnCreating', function ($size = 'w-full') {
            if ($this->isRequestActivate('size','creating')) {
                if (
                    config('nova-grid-system.stacked_auto', true)
                    && config('nova-grid-system.creating.stacked', true)
                ) {
                    $this->stacked();
                }
                $this->withMeta(['size' => $size]);
            }
            return $this;
        });

        Field::macro('stackedOnCreating', function ($stacked = true) {
            if ($this->isRequestActivate('stacked','creating')) {
                $this->stacked($stacked);
            }
            return $this;
        });

        Field::macro('removeBottomBorderOnCreating', function ($remove = true) {
            if ($this->isRequestActivate('remove_bottom_border','creating')) {
                $this->withMeta(['removeBottomBorder' => $remove]);
            }
            return $this;
        });
    }

    protected function bootUpdatingMacros()
    {
        Field::macro('sizeOnUpdating', function ($size = 'w-full') {
            if ($this->isRequestActivate('size','updating')) {
                $this->withSize($size);
            }
            return $this;
        });

        Field::macro('stackedOnUpdating', function ($stacked = true) {
            if ($this->isRequestActivate('stacked','updating')) {
                $this->stacked($stacked);
            }
            return $this;
        });

        Field::macro('removeBottomBorderOnUpdating', function ($remove = true) {
            if ($this->isRequestActivate('remove_bottom_border','updating')) {
                $this->withMeta(['removeBottomBorder' => $remove]);
            }
            return $this;
        });
    }

    protected function bootFormMacros()
    {
        Field::macro('sizeOnForms', function ($size = 'w-full') {
            if ($this->isRequestActivate('size','forms')) {
                $this->withSize($size);
            }
            return $this;
        });

        Field::macro('stackedOnForms', function ($stacked = true) {
            if ($this->isRequestActivate('stacked','forms')) {
                $this->stacked($stacked);
            }
            return $this;
        });

        Field::macro('removeBottomBorderOnForms', function ($remove = true) {
            if ($this->isRequestActivate('remove_bottom_border','forms')) {
                $this->withMeta(['removeBottomBorder' => $remove]);
            }
            return $this;
        });
    }

    protected function bootDetailMacros()
    {
        Field::macro('sizeOnDetail', function ($size = 'w-full') {
            if ($this->isRequestActivate('size','detail')) {
                $this->withSize($size);
            }
            return $this;
        });

        Field::macro('stackedOnDetail', function ($stacked = true) {
            if ($this->isRequestActivate('stacked','detail')) {
                $this->stacked($stacked);
            }
            return $this;
        });

        Field::macro('removeBottomBorderOnDetail', function ($remove = true) {
            if ($this->isRequestActivate('remove_bottom_border','detail')) {
                $this->withMeta(['removeBottomBorder' => $remove]);
            }
            return $this;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
