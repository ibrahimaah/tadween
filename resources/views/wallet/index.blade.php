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
<div class="modal fade" id="transferModal" tabindex="-1" aria-labelledby="transferModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="transferModalLabel">{{ __('wallet.transfer_funds') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('wallet.transfer') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="recipient" class="form-label">{{ __('wallet.recipient') }}</label>
                        <input type="text" class="form-control" id="recipient" name="recipient" placeholder="@username" required>
                    </div>
                    <div class="mb-3">
                        <label for="transferAmount" class="form-label">{{ __('wallet.amount') }}</label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="transferAmount" name="amount" min="1" required>
                            <span class="input-group-text">{{ __('wallet.currency_dollar') }}</span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="note" class="form-label">{{ __('wallet.note') }} ({{ __('wallet.optional') }})</label>
                        <textarea class="form-control" id="note" name="note" rows="2"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('wallet.cancel') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('wallet.transfer') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- History Modal -->
<div class="modal fade" id="historyModal" tabindex="-1" aria-labelledby="historyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="historyModalLabel">{{ __('wallet.transaction_history') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>{{ __('wallet.date') }}</th>
                                <th>{{ __('wallet.description') }}</th>
                                <th>{{ __('wallet.amount') }}</th>
                                <th>{{ __('wallet.status') }}</th>
                            </tr>
                        </thead>
                        
                        {{--
                        <tbody>
                            @foreach($allTransactions as $transaction)
                                <tr>
                                    <td>{{ $transaction->created_at->format('Y-m-d H:i') }}</td>
                                    <td>{{ $transaction->description }}</td>
                                    <td class="{{ $transaction->amount > 0 ? 'text-success' : 'text-danger' }}">
                                        {{ $transaction->amount > 0 ? '+' : '' }}{{ $transaction->amount }}
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $transaction->status == 'completed' ? 'success' : ($transaction->status == 'pending' ? 'warning' : 'danger') }}">
                                            {{ __("wallet.{$transaction->status}") }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        --}}

                        <tbody>
                            <!-- Completed Deposit -->
                            <tr>
                                <td>2023-05-15 14:30</td>
                                <td>{{ __('wallet.deposit') }} via PayPal</td>
                                <td class="text-success">+100 {{ __('wallet.currency_dollar') }}</td>
                                <td>
                                    <span class="badge bg-success">{{ __('wallet.completed') }}</span>
                                </td>
                            </tr>
                            
                            <!-- Completed Transfer -->
                            <tr>
                                <td>2023-05-10 09:15</td>
                                <td>{{ __('wallet.transfer') }} to @ahmed</td>
                                <td class="text-danger">-50 {{ __('wallet.currency_dollar') }}</td>
                                <td>
                                    <span class="badge bg-success">{{ __('wallet.completed') }}</span>
                                </td>
                            </tr>
                            
                            <!-- Pending Deposit -->
                            <tr>
                                <td>2023-05-08 16:45</td>
                                <td>{{ __('wallet.deposit') }} via {{ __('wallet.credit_debit_card') }}</td>
                                <td class="text-success">+200 {{ __('wallet.currency_dollar') }}</td>
                                <td>
                                    <span class="badge bg-warning">{{ __('wallet.pending') }}</span>
                                </td>
                            </tr>
                            
                            <!-- Failed Transfer -->
                            <tr>
                                <td>2023-05-01 11:20</td>
                                <td>{{ __('wallet.transfer') }} to @sara</td>
                                <td class="text-danger">-30 {{ __('wallet.currency_dollar') }}</td>
                                <td>
                                    <span class="badge bg-danger">{{ __('wallet.failed') }}</span>
                                </td>
                            </tr>
                            
                            <!-- Completed Deposit -->
                            <tr>
                                <td>2023-04-28 13:10</td>
                                <td>{{ __('wallet.deposit') }} via PayPal</td>
                                <td class="text-success">+75 {{ __('wallet.currency_dollar') }}</td>
                                <td>
                                    <span class="badge bg-success">{{ __('wallet.completed') }}</span>
                                </td>
                            </tr>
                            
                            <!-- Completed Transfer -->
                            <tr>
                                <td>2023-04-25 18:30</td>
                                <td>{{ __('wallet.transfer') }} to @mohammed</td>
                                <td class="text-danger">-25 {{ __('wallet.currency_dollar') }}</td>
                                <td>
                                    <span class="badge bg-success">{{ __('wallet.completed') }}</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('wallet.close') }}</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
    <script src="{{ asset('js/wallet/deposit_modal_helper.js') }}"></script>
@endpush

