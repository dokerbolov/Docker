<template>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">

            <!-- Menu/Sidebar -->
            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">

                <div class="app-brand demo">
                    <Link href="/" class="app-brand-link">

                        <span class="app-brand-text demo menu-text fw-bold ms-2">
                            Laravel
                        </span>
                    </Link>

                    <!-- FIXED TOGGLE (IMPORTANT) -->
                    <a href="javascript:void(0);"
                       class="layout-menu-toggle menu-link text-large ms-auto d-xl-none">
                        <i class="bx bx-chevron-left d-block d-xl-none align-middle"></i>
                    </a>
                </div>

                <div class="menu-divider mt-0"></div>
                <div class="menu-inner-shadow"></div>

                <ul class="menu-inner py-1">

                    <!-- Dashboard -->
                    <li class="menu-item" :class="{ active: route().current('dashboard') }">
                        <Link :href="route('dashboard')" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home-smile"></i>
                            <div class="text-truncate">Dashboard</div>
                        </Link>
                    </li>

                    <!-- Questionnaires -->
                    <li class="menu-item" :class="{ active: route().current('questionnaires') }">
                        <Link :href="route('questionnaires')" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-clipboard"></i>
                            <div class="text-truncate">Questionnaires</div>
                        </Link>
                    </li>

                    <!-- Profile -->
                    <li class="menu-item" :class="{ active: route().current('profile.show') }">
                        <Link :href="route('profile.show')" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-user"></i>
                            <div class="text-truncate">Profile</div>
                        </Link>
                    </li>

                </ul>
            </aside>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">

                <!-- Navbar -->
                <nav
                    class="layout-navbar container-xxl navbar-detached navbar navbar-expand-xl align-items-center bg-navbar-theme"
                    id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-4 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-6" href="javascript:void(0)">
                            <i class="icon-base bx bx-menu icon-md"></i>
                        </a>
                    </div>

                    <div class="navbar-nav-right d-flex align-items-center justify-content-end" id="navbar-collapse">
                        <ul class="navbar-nav flex-row align-items-center ms-md-auto">
                            <!-- User -->
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow p-0" href="javascript:void(0);"
                                   data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online">
                                        <img src="/assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle"/>
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar avatar-online">
                                                        <img src="/assets/img/avatars/1.png" alt
                                                             class="w-px-40 h-auto rounded-circle"/>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="mb-0">{{ $page.props.auth.user.name }}</h6>
                                                    <small class="text-body-secondary">Admin</small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider my-1"></div>
                                    </li>
                                    <li>
                                        <Link class="dropdown-item" :href="route('profile.edit')">
                                            <i class="icon-base bx bx-user icon-md me-3"></i><span>My Profile</span>
                                        </Link>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider my-1"></div>
                                    </li>
                                    <li>
                                        <Link class="dropdown-item" :href="route('logout')" method="post" as="button">
                                            <i class="icon-base bx bx-power-off icon-md me-3"></i><span>Log Out</span>
                                        </Link>
                                    </li>
                                </ul>
                            </li>
                            <!--/ User -->
                        </ul>
                    </div>
                </nav>
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <slot/>
                    </div>
                    <!-- / Content -->

                    <!-- Footer -->
                    <footer class="content-footer footer bg-footer-theme">
                        <div class="container-xxl">
                            <div
                                class="footer-container d-flex align-items-center justify-content-between py-4 flex-md-row flex-column">
                                <div class="mb-2 mb-md-0">
                                    © {{ new Date().getFullYear() }}, made with ❤️ by ThemeSelection
                                </div>
                            </div>
                        </div>
                    </footer>
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->
</template>

<script setup>
import {Link} from '@inertiajs/vue3';

import { onMounted, nextTick } from 'vue'
import { router } from '@inertiajs/vue3'

function bindSidebarToggle() {
    const toggle = document.querySelectorAll('.layout-menu-toggle')

    toggle.forEach(el => {
        if (el.dataset.bound) return

        el.addEventListener('click', (e) => {
            e.preventDefault()
            document.body.classList.toggle('layout-menu-expanded')
        })

        el.dataset.bound = 'true'
    })
}

onMounted(() => {
    nextTick(bindSidebarToggle)
})

router.on('finish', () => {
    nextTick(bindSidebarToggle)
})
</script>

