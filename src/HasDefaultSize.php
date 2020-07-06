<?php


namespace CodencoDev\NovaGridSystem;


use Laravel\Nova\Fields\Field;
use Laravel\Nova\Http\Requests\NovaRequest;

trait HasDefaultSize
{

    /**
     * Get the fields that are available for the given request with size meta
     *
     * @param NovaRequest $request
     * @return \Laravel\Nova\Fields\FieldCollection
     */
    public function availableFields(NovaRequest $request)
    {
        return parent::availableFields($request)->map(function (Field $item) {
            if ($item->component == 'heading-field') {
                return $item->size('w-full');
            }
            if (isset($item->meta['size'])) {
                return $item;
            }
            $detail = method_exists($this,'defaultFieldSizeOnDetail')
                ? $this->defaultFieldSizeOnDetail()
                : (method_exists($this,'defaultFieldSize')
                    ? $this->defaultFieldSize()
                    : config('nova-grid-system.default_size.detail', 'w-full'));

            $creating = method_exists($this,'defaultFieldSizeOnCreating')
                ? $this->defaultFieldSizeOnCreating()
                : (method_exists($this,'defaultFieldSize')
                    ? $this->defaultFieldSize()
                    : config('nova-grid-system.default_size.creating', 'w-full'));

            $updating = method_exists($this,'defaultFieldSizeOnUpdating')
                ? $this->defaultFieldSizeOnUpdating()
                : (method_exists($this,'defaultFieldSize')
                    ? $this->defaultFieldSize()
                    : config('nova-grid-system.default_size.updating', 'w-full'));

            return $item
                ->sizeOnDetail($detail)
                ->sizeOnCreating($creating)
                ->sizeOnUpdating($updating);

        });
    }
}
