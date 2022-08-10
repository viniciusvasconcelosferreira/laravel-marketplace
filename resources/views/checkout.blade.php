@extends('layouts.front')

@section('content')
    <div class="container">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <h2>Dados para Pagamento</h2>
                    <hr>
                </div>
            </div>
            <form action="" method="post">

                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="card_number">
                            Número do Cartão
                        </label>
                        <input id="card_number" type="text" name="card_number" class="form-control">
                        <input id="card_brand" type="hidden" name="card_brand" class="form-control">
                        <span class="brand"></span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 form-group">
                        <label for="card_month">
                            Mês de Expiração
                        </label>
                        <input id="card_month" type="text" name="card_month" class="form-control">
                    </div>

                    <div class="col-md-4 form-group">
                        <label for="card_year">
                            Ano de Expiração
                        </label>
                        <input id="card_year" type="text" name="card_year" class="form-control">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-5 form-group">
                        <label for="">
                            Código de Segurança
                        </label>
                        <input type="text" name="card_cvv" class="form-control">
                    </div>
                    <div class="col-md-12 installments form-group"></div>
                </div>

                <button class="btn btn-success btn-lg processCheckout">Efetuar Pagamento</button>

            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript"
            src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>
    {{--    https://projects.jga.me/jquery-builder/--}}
    <script src="{{asset('assets/js/jquery-ajax.min.js')}}"></script>

    <script>
        const sessionId = '{{session()->get('pagseguro_session_code')}}';
        PagSeguroDirectPayment.setSessionId(sessionId);
    </script>

    <script>
        let cardNumber = document.querySelector('input[name=card_number]');
        let spanBrand = document.querySelector('span.brand');

        cardNumber.addEventListener('keyup', function () {
            if (cardNumber.value.length >= 6) {
                PagSeguroDirectPayment.getBrand({
                    cardBin: cardNumber.value.substr(0, 6),
                    success: function (res) {
                        spanBrand.innerHTML = `<img src="https://stc.pagseguro.uol.com.br/public/img/payment-methods-flags/68x30/${res.brand.name}.png" alt=""/>`;
                        document.querySelector('input[name=card_brand]').value = res.brand.name;
                        getInstallments(40, res.brand.name);
                    },
                    error: function (err) {
                        console.log(err);
                    },
                    complete: function (res) {
                        //console.log('Complete: ', res);
                    }
                });
            }
        });

        let submitButton = document.querySelector('button.processCheckout');

        submitButton.addEventListener('click', function (event) {
            //nao executar o evento padrao de submit
            event.preventDefault();

            PagSeguroDirectPayment.createCardToken({
                cardNumber: document.querySelector('input[name=card_number]').value,
                brand: document.querySelector('input[name=card_brand]').value,
                cvv: document.querySelector('input[name=card_cvv]').value,
                expirationMonth: document.querySelector('input[name=card_month]').value,
                expirationYear: document.querySelector('input[name=card_year]').value,
                success: function (res) {
                    console.log(res);
                    proccessPayment(res.card.token);
                }
            });
        });

        function proccessPayment(token) {
            //envio de requisicoes sem reload da pagina
            let data = {
                card_token: token,
                //hash para identificar o usuario que esta fazendo a requisicao
                hash: PagSeguroDirectPayment.getSenderHash(),
                installment: document.querySelector('select.select_installments').value,
                _token: '{{csrf_token()}}'
            }
            $.ajax({
                type: 'POST',
                url: '{{route('checkout.proccess')}}',
                data: data,
                dataType: 'json',
                success: function (res) {
                    console.log(res);
                }
            });
        }

        function getInstallments(amount, brand) {
            PagSeguroDirectPayment.getInstallments({
                amount: amount,
                brand: brand,
                maxInstallmentNoInterest: 0,
                success: function (res) {
                    document.querySelector('div.installments').innerHTML = drawSelectInstallments(res.installments[brand]);
                    console.log(res);
                },
                error: function (err) {
                    console.log(err);
                },
                complete: function (res) {
                    //console.log('Complete: ', res);
                }
            });
        }

        function drawSelectInstallments(installments) {
            let select = '<label>Opções de Parcelamento:</label>';

            select += '<select class="form-control select_installments">';

            for (let l of installments) {
                select += `<option value="${l.quantity}|${l.installmentAmount}">${l.quantity}x de ${l.installmentAmount} - Total fica ${l.totalAmount}</option>`;
            }


            select += '</select>';

            return select;
        }
    </script>
@endsection
