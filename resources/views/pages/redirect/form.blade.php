<x-page.form
        title="{{ $redirect->exists ? __('Update :name', ['name' => __(config('admix-redirects.name'))]) : __('Create :name', ['name' => __(config('admix-redirects.name'))]) }}">
    <div class="row">
        <div class="col-md-6 mb-3">
            <x-form.label for="form.is_active">
                {{ str(__('admix-redirects::fields.is_active'))->ucfirst() }}
            </x-form.label>
            <x-form.toggle
                    name="form.is_active"
                    :large="true"
                    :label-on="__('Yes')"
                    :label-off="__('No')"
            />
        </div>
        <div class="col-md-6 mb-3">
        </div>
        <div class="col-md-6 mb-3">
            <x-form.select
                    name="form.type"
                    :label="__('admix-redirects::fields.type')"
                    :options="config('admix-redirects.types')"
            />
        </div>
        <div class="col-md-6 mb-3">
            <!-- -->
        </div>
        <div class="col-md-6 mb-3">
            <x-form.input
                    name="form.from"
                    :label="__('admix-redirects::fields.from')"
                    placeholder="/contato"
            />
        </div>
        <div class="col-md-6 mb-3">
            <x-form.input
                    name="form.to"
                    :label="__('admix-redirects::fields.to')"
                    placeholder="https://fmd.ag"
            />
        </div>
    </div>

    <x-slot:complement>
        @if($redirect->exists)
            <div class="mb-3">
                <x-form.plaintext :label="__('admix::fields.id')"
                                  :value="$redirect->id"/>
            </div>
            <div class="mb-3">
                <x-form.plaintext :label="__('admix::fields.created_at')"
                                  :value="$redirect->created_at->format(config('admix.timestamp.format'))"/>
            </div>
            <div class="mb-3">
                <x-form.plaintext :label="__('admix::fields.updated_at')"
                                  :value="$redirect->updated_at->format(config('admix.timestamp.format'))"/>
            </div>
        @endif
    </x-slot:complement>
</x-page.form>
