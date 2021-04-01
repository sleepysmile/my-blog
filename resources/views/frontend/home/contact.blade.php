@extends('frontend.layouts.main')

@section('title', 'My blog main page')

@section('content')
    <main class="row content__page">

        <section class="column large-full entry format-standard">

            {!! $text !!}

            <h3 class="h2">Say Hello</h3>

            <form class="js-commentForm"
                  name="contactForm"
                  id="contactForm"
                  method="post"
                  action="{{ route('frontend.feedback.create') }}"
                  autocomplete="off"
                  data-error-box=".js-errorBox"
            >
                @csrf
                <fieldset>
                    <div class="alert-box alert-box--error hideit js-errorBox" style="display: none">
                        <i class="fa fa-times alert-box__close" aria-hidden="true"></i>
                    </div>
                    <div class="form-field">
                        <input name="name" id="cName" class="full-width" placeholder="Your Name" value="" type="text">
                    </div>

                    <div class="form-field">
                        <input name="email" id="cEmail" class="full-width" placeholder="Your Email" value="" type="text">
                    </div>

                    <div class="form-field">
                        <input name="website" id="cWebsite" class="full-width" placeholder="Website" value="" type="text">
                    </div>

                    <div class="message form-field">
                        <textarea name="message" id="cMessage" class="full-width" placeholder="Your Message"></textarea>
                    </div>

                    <input name="submit" id="submit" class="btn btn--primary btn-wide btn--large full-width" value="Send Message" type="submit">

                </fieldset>
            </form> <!-- end form -->

        </section>

    </main>
@stop
