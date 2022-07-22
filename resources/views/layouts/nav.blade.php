<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm p-2">
    <div class="container">
        
        <a class="navbar-brand text-primary font-weight-bold text-uppercase" href="{{ url('/') }}">
            Mooncam Admin
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Dashboard</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            Apps <span class="caret"></span>
                        </a>
                        
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            @can('view-any', App\Models\User::class)
                            <a class="dropdown-item" href="{{ route('users.index') }}">Users</a>
                            @endcan
                            @can('view-any', App\Models\AmountConversion::class)
                            <a class="dropdown-item" href="{{ route('amount-conversions.index') }}">Amount Conversions</a>
                            @endcan
                            @can('view-any', App\Models\BankDetails::class)
                            <a class="dropdown-item" href="{{ route('all-bank-details.index') }}">All Bank Details</a>
                            @endcan
                            @can('view-any', App\Models\CallPrice::class)
                            <a class="dropdown-item" href="{{ route('call-prices.index') }}">Call Prices</a>
                            @endcan
                            @can('view-any', App\Models\CountryList::class)
                            <a class="dropdown-item" href="{{ route('country-lists.index') }}">Country Lists</a>
                            @endcan
                            @can('view-any', App\Models\FreeTokenTransaction::class)
                            <a class="dropdown-item" href="{{ route('free-token-transactions.index') }}">Free Token Transactions</a>
                            @endcan
                            @can('view-any', App\Models\Gallery::class)
                            <a class="dropdown-item" href="{{ route('galleries.index') }}">Galleries</a>
                            @endcan
                            @can('view-any', App\Models\GiftList::class)
                            <a class="dropdown-item" href="{{ route('gift-lists.index') }}">Gift Lists</a>
                            @endcan
                            @can('view-any', App\Models\GiftTransaction::class)
                            <a class="dropdown-item" href="{{ route('gift-transactions.index') }}">Gift Transactions</a>
                            @endcan
                            @can('view-any', App\Models\RechargeAmount::class)
                            <a class="dropdown-item" href="{{ route('recharge-amounts.index') }}">Recharge Amounts</a>
                            @endcan
                            @can('view-any', App\Models\ReportAndBlock::class)
                            <a class="dropdown-item" href="{{ route('report-and-blocks.index') }}">Report And Blocks</a>
                            @endcan
                            @can('view-any', App\Models\VideoCallTransaction::class)
                            <a class="dropdown-item" href="{{ route('video-call-transactions.index') }}">Video Call Transactions</a>
                            @endcan
                            @can('view-any', App\Models\Wallet::class)
                            <a class="dropdown-item" href="{{ route('wallets.index') }}">Wallets</a>
                            @endcan
                            @can('view-any', App\Models\WithdrawlTransaction::class)
                            <a class="dropdown-item" href="{{ route('withdrawl-transactions.index') }}">Withdrawl Transactions</a>
                            @endcan
                            @can('view-any', App\Models\HostProfile::class)
                            <a class="dropdown-item" href="{{ route('host-profiles.index') }}">Host Profiles</a>
                            @endcan
                        </div>

                    </li>
                @endauth
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>