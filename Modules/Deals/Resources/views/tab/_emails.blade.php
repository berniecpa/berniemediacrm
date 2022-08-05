<section class="scrollable bg">
  @if(isAdmin() || can('deals_send_email'))
  @widget('Emails\SendContactEmail', ['id' => $deal->company->contact->id, 'subject' => optional($deal->company->contact->emails->first())->subject])
  @widget('Emails\ShowEmails', ['emails' => $deal->company->contact->emails])
  @endif
</section>
@push('pagestyle')
@include('stacks.css.datepicker')
@endpush
@push('pagescript')
@include('stacks.js.datepicker')
<script>
  $('.datetimepicker-input').datetimepicker({showClose: true, showClear: true, minDate: moment() });
   
    $( "#sendLater" ).click(function() {
      $("#queueLater").show("fast");
      $( ".datetimepicker-input" ).focus();
    });
</script>
@endpush