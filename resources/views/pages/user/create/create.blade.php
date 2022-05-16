<x-base-layout>
    <div id="kt_content" class="content d-flex flex-column flex-column-fluid">
        {{ theme()->getView('pages/user/create/_details', array('class' => 'mb-5 mb-xl-10', 'roles' => $roles)) }}
    </div>
</x-base-layout>
