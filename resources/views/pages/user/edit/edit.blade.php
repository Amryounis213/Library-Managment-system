<x-base-layout>
    <div id="kt_content" class="content d-flex flex-column flex-column-fluid">
        {{ theme()->getView('pages/user/edit/_details', array('class' => 'mb-5 mb-xl-10', 'user' => $user, 'roles' => $roles)) }}
        {{ theme()->getView('pages/user/edit/_signin-method', array('class' => 'mb-5 mb-xl-10', 'user' => $user)) }}
    </div>
</x-base-layout>
