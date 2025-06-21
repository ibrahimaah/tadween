@extends('layouts.main_app')

@section('pageTitle',__('home.wallet'))
 

@push('styles')
<style>
    .card {
        border-radius: 10px;
        border: none;
    }
    .card-header {
        border-radius: 10px 10px 0 0 !important;
    }
    .list-group-item {
        transition: all 0.3s;
    }
    .list-group-item:hover {
        background-color: #f8f9fa;
    }
    .badge {
        font-weight: 500;
    }
    /* RTL support */
    [dir="rtl"] .form-check-input {
        margin-left: 0.5em;
        margin-right: -1.5em;
    }
</style>
@endpush


@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Wallet Balance Card -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-orange text-white d-flex justify-content-between align-items-center">
                    <h3 class="mb-0 {{ app()->getLocale() == 'ar' ? 'text-end' : '' }}">
                        {{ __('wallet.your_balance') }}
                    </h3>
                    <span class="badge bg-light text-dark fs-4">
                        <span id="balance">{{ auth()->user()->balance }}  </span>
                        {{ __('wallet.currency_dollar') }}
                    </span>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between {{ app()->getLocale() == 'ar' ? 'flex-row-reverse' : '' }}">
                        <button class="btn btn-success px-4" data-bs-toggle="modal" data-bs-target="#depositModal">
                            <i class="fas fa-plus-circle me-2"></i>
                            {{ __('wallet.deposit') }}
                        </button>
                        <button class="btn btn-orange text-light px-4" data-bs-toggle="modal" data-bs-target="#transferModal">
                            <i class="fas fa-paper-plane me-2"></i>
                            {{ __('wallet.transfer') }}
                        </button>
                        <button class="btn btn-secondary px-4" data-bs-toggle="modal" data-bs-target="#historyModal">
                            <i class="fas fa-history me-2"></i>
                            {{ __('wallet.history') }}
                        </button>
                    </div>
                </div>
            </div>

            <!-- Recent Transactions -->
            @include('wallet.partials._recent_transactions')
        </div>
    </div>
</div>

<!-- Deposit Modal -->
@include('wallet.partials._depositModal')

<!-- Transfer Modal -->
@include('wallet.partials._transferModal')

<!-- History Modal -->
@include('wallet.partials._history_modal')
@endsection

@push('js')
    <script src="{{ asset('js/wallet/deposit_modal_helper.js') }}"></script>
    <script>
    $(function() {
        $('#transferModal').on('shown.bs.modal', function () {
            $('#recipient').select2({
                dropdownParent: $('#transferModal')
            });
        });
    });
    </script>
@endpush

