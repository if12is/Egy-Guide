        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
            <div class="app-brand demo">
                <a href="{{ route('admin.dashboard') }}" class="app-brand-link">
                    <span class="app-brand-logo demo">
                        <svg width="32" height="22" viewBox="0 0 32 22" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z"
                                fill="#7367F0"></path>
                            <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
                                d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z" fill="#161616">
                            </path>
                            <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
                                d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z" fill="#161616">
                            </path>
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z"
                                fill="#7367F0"></path>
                        </svg>
                    </span>
                    <span class="app-brand-text demo menu-text fw-bold">Dashboard</span>
                </a>

                <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
                    <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
                    <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
                </a>
            </div>
            <div class="menu-inner-shadow"></div>

            <ul class="menu-inner py-1">
                <!-- Dashboards -->
                <li class="menu-item active open">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons ti ti-smart-home"></i>
                        <div data-i18n="Dashboards">Dashboards</div>
                        <div class="badge bg-label-primary rounded-pill ms-auto">1</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item active">
                            <a href="{{ route('admin.dashboard') }}" class="menu-link">
                                <div data-i18n="Analytics">Analytics</div>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Layouts -->
                {{-- <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons ti ti-layout-sidebar"></i>
                        <div data-i18n="Layouts">Layouts</div>
                    </a>

                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="layouts-collapsed-menu.html" class="menu-link">
                                <div data-i18n="Collapsed menu">Collapsed menu</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="layouts-content-navbar.html" class="menu-link">
                                <div data-i18n="Content navbar">Content navbar</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="layouts-content-navbar-with-sidebar.html" class="menu-link">
                                <div data-i18n="Content nav + Sidebar">Content nav + Sidebar</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="../horizontal-menu-template" class="menu-link" target="_blank">
                                <div data-i18n="Horizontal">Horizontal</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="layouts-without-menu.html" class="menu-link">
                                <div data-i18n="Without menu">Without menu</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="layouts-without-navbar.html" class="menu-link">
                                <div data-i18n="Without navbar">Without navbar</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="layouts-fluid.html" class="menu-link">
                                <div data-i18n="Fluid">Fluid</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="layouts-container.html" class="menu-link">
                                <div data-i18n="Container">Container</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="layouts-blank.html" class="menu-link">
                                <div data-i18n="Blank">Blank</div>
                            </a>
                        </li>
                    </ul>
                </li> --}}

                <!-- Apps & Pages -->
                <li class="menu-header small text-uppercase">
                    <span class="menu-header-text">Apps &amp; Pages</span>
                </li>
                <li class="menu-item">
                    <a href="{{ route('admin.dashboardpage1') }}" class="menu-link">
                        <i class="menu-icon tf-icons ti ti-users"></i>
                        <div data-i18n="User">User</div>
                    </a>
                </li>
                {{-- <li class="menu-item">
                    <a href="#" class="menu-link">
                        <i class="menu-icon tf-icons ti ti-messages"></i>
                        <div data-i18n="Chat">Chat</div>
                    </a>
                </li> --}}
                <li class="menu-item">
                    <a href="app-calendar.html" class="menu-link">
                        <i class="menu-icon tf-icons ti ti-calendar"></i>
                        <div data-i18n="Category">Category</div>
                    </a>
                </li>
                {{--  <li class="menu-item">
                    <a href="app-kanban.html" class="menu-link">
                        <i class="menu-icon tf-icons ti ti-layout-kanban"></i>
                        <div data-i18n="Kanban">Kanban</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons ti ti-file-dollar"></i>
                        <div data-i18n="Invoice">Invoice</div>
                        <div class="badge bg-label-danger rounded-pill ms-auto">4</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="app-invoice-list.html" class="menu-link">
                                <div data-i18n="List">List</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="app-invoice-preview.html" class="menu-link">
                                <div data-i18n="Preview">Preview</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="app-invoice-edit.html" class="menu-link">
                                <div data-i18n="Edit">Edit</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="app-invoice-add.html" class="menu-link">
                                <div data-i18n="Add">Add</div>
                            </a>
                        </li>
                    </ul>
                </li> --}}
                {{-- <li class="menu-item">
                    <a href="{{ route('admin.dashboardpage1') }}" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons ti ti-users"></i>
                        <div data-i18n="Users">Users</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="{{ route('admin.dashboardpage1') }}" class="menu-link">
                                <div data-i18n="List">List</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <div data-i18n="View">View</div>
                            </a>
                            <ul class="menu-sub">
                                <li class="menu-item">
                                    <a href="app-user-view-account.html" class="menu-link">
                                        <div data-i18n="Account">Account</div>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a href="app-user-view-security.html" class="menu-link">
                                        <div data-i18n="Security">Security</div>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a href="app-user-view-billing.html" class="menu-link">
                                        <div data-i18n="Billing & Plans">Billing & Plans</div>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a href="app-user-view-notifications.html" class="menu-link">
                                        <div data-i18n="Notifications">Notifications</div>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a href="app-user-view-connections.html" class="menu-link">
                                        <div data-i18n="Connections">Connections</div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons ti ti-settings"></i>
                        <div data-i18n="Roles & Permissions">Roles & Permissions</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="app-access-roles.html" class="menu-link">
                                <div data-i18n="Roles">Roles</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="app-access-permission.html" class="menu-link">
                                <div data-i18n="Permission">Permission</div>
                            </a>
                        </li>
                    </ul>
                </li> --}}



        </aside>
        <!-- / Menu -->
