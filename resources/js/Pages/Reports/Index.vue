<script setup>
import MainLayout from '@/Layouts/MainLayout.vue'
import { computed } from 'vue'
import { usePage } from '@inertiajs/vue3'
import BarChart from '@/Components/BarChart.vue'
import LineChart from '@/Components/LineChart.vue'
import PieChart from '@/Components/PieChart.vue'

const page = usePage()
const invoices = computed(() => page.props.invoices)
const totalPaid = computed(() => page.props.totalPaid)
const monthlyPayments = computed(() => page.props.monthlyPayments)
const monthlyInvoiceCounts = computed(() => page.props.monthlyInvoiceCounts)

const activeCount = computed(() => page.props.activeCount)
const plansSummary = computed(() => page.props.plansSummary)
const monthlySubscriptions = computed(() => page.props.monthlySubscriptions)
</script>

<template>
    <MainLayout>
        <div class="container-fluid p-0">
            <h1 class="h3 mb-4"><strong>Reports</strong> - User Insights</h1>



            <!-- <div class="row mb-4">
                <div class="col-md-6">

                    <div class="card-body d-flex w-100">
                        <div class="align-self-center chart chart-lg">
                            <h5 class="card-title">Monthly Payments</h5>
                            <BarChart />
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card d-flex w-100">
                        <div class="card-body">
                            <h5 class="card-title">Monthly Invoice Count</h5>
                            <LineChart />
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">Monthly Subscriptions</h5>
                            <LineChart :data="monthlySubscriptions" />
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">Plan Distribution</h5>
                            <PieChart :data="plansSummary" />
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="row ">
                <div class="col-xl-6 col-xxl-5 d-flex">
                    <div class="w-100">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col mt-0">
                                                <h5 class="card-title">Total Paid</h5>
                                            </div>

                                            <div class="col-auto">
                                                <div class="stat text-primary">
                                                    <i class="align-middle" data-feather="truck"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <h1 class="mt-1 mb-3">${{ totalPaid }}</h1>
                                        <div class="mb-0">
                                            <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> -3.65%
                                            </span>
                                            <span class="text-muted">{{ activeCount }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col mt-0">
                                                <h5 class="card-title">Active Subscriptions</h5>
                                            </div>

                                            <div class="col-auto">
                                                <div class="stat text-primary">
                                                    <i class="align-middle" data-feather="users"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <h1 class="mt-1 mb-3">14.212</h1>
                                        <div class="mb-0">
                                            <span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> 5.25%
                                            </span>
                                            <span class="text-muted">Since last week</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col mt-0">
                                                <h5 class="card-title">Invoices</h5>
                                            </div>

                                            <div class="col-auto">
                                                <div class="stat text-primary">
                                                    <i class="align-middle" data-feather="dollar-sign"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <h1 class="mt-1 mb-3">{{ invoices.length }}</h1>
                                        <div class="mb-0">
                                            <span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> 6.65%
                                            </span>
                                            <span class="text-muted">Since last week</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col mt-0">
                                                <h5 class="card-title">Orders</h5>
                                            </div>

                                            <div class="col-auto">
                                                <div class="stat text-primary">
                                                    <i class="align-middle" data-feather="shopping-cart"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <h1 class="mt-1 mb-3">64</h1>
                                        <div class="mb-0">
                                            <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> -2.25%
                                            </span>
                                            <span class="text-muted">Since last week</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-xxl-7">
                    <div class="card flex-fill w-100">
                        <div class="card-header">

                            <h5 class="card-title mb-0">Recent Movement</h5>
                        </div>
                        <div class="card-body py-3">
                            <div class="chart chart-sm">
                                <LineChart :data="monthlySubscriptions" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Invoices List</h5>
                </div>
                <div class="card-body">
                    <div v-if="invoices.length">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Invoice #</th>
                                    <th>Plan</th>
                                    <th>Amount</th>
                                    <th>Due Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="invoice in invoices" :key="invoice.id">
                                    <td>{{ invoice.invoice_number }}</td>
                                    <td>{{ invoice.subscription.plan.name }}</td>
                                    <td>${{ invoice.amount }}</td>
                                    <td>{{ invoice.due_date }}</td>
                                    <td>
                                        <span :class="invoice.is_paid ? 'text-success' : 'text-danger'">
                                            {{ invoice.is_paid ? 'Paid' : 'Unpaid' }}
                                        </span>
                                    </td>
                                    <td>
                                        <a :href="`/invoices/${invoice.id}/download`"
                                            class="btn btn-sm btn-outline-primary">
                                            Download
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div v-else class="text-muted">No invoices found.</div>
                </div>
            </div>
        </div>
    </MainLayout>
</template>
