<div id="crm-admin-options-form-block-is_donation" style="margin: 10px 0% 0px -140px;">
  <span class="label">
    {$form.is_donation.label}
  </span>
  <span class="html-adjust">
    {$form.is_donation.html}
  </span>
</div>


{literal}
<script type="text/javascript">
CRM.$(function($) {
  $('#crm-admin-options-form-block-is_donation').insertAfter('#max_value');
  if ($('#html_type').val() == "Text") {
    $("#crm-admin-options-form-block-is_donation").show();
  }
  else {
    $("#crm-admin-options-form-block-is_donation").hide();
  }
});
</script>
{/literal}
