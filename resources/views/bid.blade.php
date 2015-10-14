@extends('app')

@section('content')
    <section class="section--center mdl-grid mdl-grid--no-spacing mdl-shadow--2dp">
        <header class="mdl-cell mdl-cell--4-col-desktop mdl-cell--2-col-tablet mdl-cell--4-col-phone mdl-color--white-100">
            <img src="{{$product->image}}" alt="" height="200px" style="overflow: hidden;">
        </header>
        <div class="mdl-card mdl-cell mdl-cell--8-col-desktop mdl-cell--6-col-tablet mdl-cell--4-col-phone">
            <div class="mdl-card__supporting-text">
                <h4>{{$product->name}}</h4>
                {{$product->description}}
                <br><br>
                <strong>Base price : {{$product->price}} $ &nbsp;
                    Current bid: {{@$product->bids->first()->amount ?: 0}} $</strong>

                <!-- Numeric Textfield -->
                <form action="product/{{$product->id}}/bid" method="POST">
                    {!! csrf_field() !!}
                    <input type="hidden" name="username" value="">
                    <input type="hidden" name="product_id" value="{{$product->id}}">
                    <div class="mdl-textfield mdl-js-textfield">
                        <input class="mdl-textfield__input" type="text" pattern="-?[0-9]*(\.[0-9]+)?" id="bid" name="amount" />
                        <label class="mdl-textfield__label" for="sample2">Your bid</label>
                        <span class="mdl-textfield__error">Input must be a number!</span>
                    </div>
                    <!-- Raised disabled button-->
                    <br>
                    <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" type="submit" id="submit">
                        Bid NOW !
                    </button>
                </form>
            </div>
        </div>
    </section>
    <section class="section--center mdl-grid mdl-grid--no-spacing mdl-shadow--2dp">
        <div class="mdl-card mdl-cell mdl-cell--12-col">
            <div class="mdl-card__supporting-text mdl-grid mdl-grid--no-spacing">
                <h4 class="mdl-cell mdl-cell--12-col">Bids</h4>
                @foreach($product->bids as $bid)
                    <div class="section__circle-container mdl-cell mdl-cell--2-col mdl-cell--1-col-phone">
                        <h3>{{$bid->amount}} $ </h3>
                    </div>
                    <div class="section__text mdl-cell mdl-cell--10-col-desktop mdl-cell--6-col-tablet mdl-cell--3-col-phone">
                        <br><h5>{{$bid->username}}</h5>
                        This bid was set {{$bid->created_at->diffForHumans()}}.
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection()

@section('javascript')
<script>
    $(document).ready(function() {
        login();

    });





    function login() {
        if (localStorage.getItem('username') == null) {

            var $form = '<div class="mdl-textfield mdl-js-textfield"><input class="mdl-textfield__input" type="text" id="username" /><label class="mdl-textfield__label" for="username">Your name goes here</label></div>';

            showDialog({
                title: 'Tell me, stranger : What is your name ?',
                text: $form,
                negative: null,
                cancelable: false,
                positive: {
                    title: 'Save my name',
                    onClick: function (e) {
                        localStorage.setItem('username', $('input#username').val());
                        location.reload();
                    }
                }
            });
        } else {
            $('input[name="username"]').val(localStorage.getItem('username'));
        }
    }
</script>
@endsection