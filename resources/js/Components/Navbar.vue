<script setup>
import { computed } from 'vue'
import { usePage } from '@inertiajs/vue3'

const page = usePage()
const user = page.props.auth.user



const notifications = computed(() => page.props.notifications || [])
const unreadNotifications = computed(() =>
    notifications.value.filter(n => !n.read_at)
)
</script>
<template>
    <div class="navbar-collapse collapse">
        <ul class="navbar-nav navbar-align">
            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-bs-toggle="dropdown">
                    <div class="position-relative">
                        <i class="align-middle" data-feather="bell"></i>
                        <span v-if="unreadNotifications.length > 0" class="indicator"
                             >{{ unreadNotifications.length }}</span>
                    </div>
                </a>

                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="alertsDropdown">
                    <div class="dropdown-menu-header">
                        {{ unreadCount }} New Notifications
                    </div>

                    <div class="list-group" v-if="unreadNotifications.length">
                        <a v-for="notif in unreadNotifications.slice(0, 5)" :key="notif.id" href="/notifications"
                            class="list-group-item">
                            <div class="row g-0 align-items-center">
                                <div class="col-2">
                                    <i class="text-primary" data-feather="bell"></i>
                                </div>
                                <div class="col-10">
                                    <div class="text-dark">{{ notif.data.message }}</div>
                                    <div class="text-muted small mt-1">{{ new Date(notif.created_at).toLocaleString() }}
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div v-else class="text-center text-muted py-3">
                        No notifications yet
                    </div>

                    <div class="dropdown-menu-footer">
                        <a href="/notifications" class="text-muted">Show all notifications</a>
                    </div>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle" href="#" id="messagesDropdown" data-bs-toggle="dropdown">
                    <div class="position-relative">
                        <i class="align-middle" data-feather="message-square"></i>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="messagesDropdown">
                    <div class="dropdown-menu-header">
                        <div class="position-relative">
                            4 New Messages
                        </div>
                    </div>
                    <div class="list-group">
                        <a href="#" class="list-group-item">
                            <div class="row g-0 align-items-center">
                                <div class="col-2">
                                    <img src="/adminkit/img/avatars/avatar-5.jpg"
                                        class="avatar img-fluid rounded-circle" alt="Vanessa Tucker">
                                </div>
                                <div class="col-10 ps-2">
                                    <div class="text-dark">Vanessa Tucker</div>
                                    <div class="text-muted small mt-1">Nam pretium turpis et arcu. Duis arcu
                                        tortor.</div>
                                    <div class="text-muted small mt-1">15m ago</div>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item">
                            <div class="row g-0 align-items-center">
                                <div class="col-2">
                                    <img src="/adminkit/img/avatars/avatar-2.jpg"
                                        class="avatar img-fluid rounded-circle" alt="William Harris">
                                </div>
                                <div class="col-10 ps-2">
                                    <div class="text-dark">William Harris</div>
                                    <div class="text-muted small mt-1">Curabitur ligula sapien euismod
                                        vitae.</div>
                                    <div class="text-muted small mt-1">2h ago</div>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item">
                            <div class="row g-0 align-items-center">
                                <div class="col-2">
                                    <img src="/adminkit/img/avatars/avatar-4.jpg"
                                        class="avatar img-fluid rounded-circle" alt="Christina Mason">
                                </div>
                                <div class="col-10 ps-2">
                                    <div class="text-dark">Christina Mason</div>
                                    <div class="text-muted small mt-1">Pellentesque auctor neque nec urna.
                                    </div>
                                    <div class="text-muted small mt-1">4h ago</div>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item">
                            <div class="row g-0 align-items-center">
                                <div class="col-2">
                                    <img src="/adminkit/img/avatars/avatar-3.jpg"
                                        class="avatar img-fluid rounded-circle" alt="Sharon Lessman">
                                </div>
                                <div class="col-10 ps-2">
                                    <div class="text-dark">Sharon Lessman</div>
                                    <div class="text-muted small mt-1">Aenean tellus metus, bibendum sed,
                                        posuere ac, mattis non.</div>
                                    <div class="text-muted small mt-1">5h ago</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="dropdown-menu-footer">
                        <a href="#" class="text-muted">Show all messages</a>
                    </div>
                </div>
            </li>


            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                    <i class="align-middle" data-feather="settings"></i>
                </a>

                <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                    <img :src="user.avatar || '/adminkit/img/avatars/avatar.jpg'" class="avatar img-fluid rounded me-1"
                        alt="User Avatar" />
                    <span class="text-dark">{{ user.name }}</span>
                </a>

                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="/profile">
                        <i class="align-middle me-1" data-feather="user"></i> Profile
                    </a>
                    <a class="dropdown-item" href="/analytics">
                        <i class="align-middle me-1" data-feather="pie-chart"></i> Analytics
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/settings">
                        <i class="align-middle me-1" data-feather="settings"></i> Settings & Privacy
                    </a>
                    <a class="dropdown-item" href="/help">
                        <i class="align-middle me-1" data-feather="help-circle"></i> Help Center
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/logout">Log out</a>
                </div>
            </li>

        </ul>
    </div>
</template>
