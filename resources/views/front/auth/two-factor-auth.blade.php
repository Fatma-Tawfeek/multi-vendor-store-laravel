<x-front-layout title="Two Factor Authentication">

    <!-- Start Account Login Area -->
    <div class="account-login section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
                    <form class="card login-form" action="{{ route('two-factor.enable') }}" method="post">
                        @csrf
                        <div class="card-body">

                            <div class="title">
                                <h3>Two Factor Authentication</h3>
                                <p>You can Enable/Disable Two Factor Authentication.</p>
                            </div>
                            @if (session('status') == 'two-factor-authentication-enabled')
                                <div class="mb-4 font-medium text-sm">
                                    Please finish configuring your two factor authentication below.
                                </div>
                            @endif
                            <div class="button">
                                @if (!auth()->user()->two_factor_secret)
                                    <button class="btn" type="submit">Enable</button>
                                @else
                                    <div class="p-4">
                                        {!! Auth::user()->twoFactorQrCodeSvg() !!}
                                    </div>
                                    <h3>Recover codes</h3>
                                    <ul>
                                        @foreach (auth()->user()->recoveryCodes() as $code)
                                            <li>{{ $code }}</li>
                                        @endforeach
                                    </ul>

                                    @method('delete')
                                    <button class="btn btn-danger mt-2" type="submit">Disable</button>
                                @endif
                            </div>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Account Login Area -->

</x-front-layout>
