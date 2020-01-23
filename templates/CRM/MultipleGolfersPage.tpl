<div id="multiplehonorees" class="crm-public-form-item crm-group custom_post_profile-group">
  <div class="crm-public-form-item crm-group">
{section name='i' start=1 loop=5}
  {assign var='rowNumber' value=$smarty.section.i.index}
  <div id="add-item-row-{$rowNumber}" class="{cycle values="odd-row,even-row"}">
    <fieldset><legend>{ts}Participant {$rowNumber}{/ts}</legend>
    <div class="crm-section">
      <div class="label">
        {ts}First Name{/ts}
      </div>
      <div class="content">
        {$golfers.first_name.$rowNumber}<br>
      </div>
    </div>
    <br/>
    <div class="crm-section">
      <div class="label">
        {ts}Last Name{/ts}
      </div>
      <div class="content">
        {$golfers.last_name.$rowNumber}
      </div>
    </div>
    {if $rowNumber > 1}
      <div class="crm-section">
        <div class="label">
          {ts}Email Address{/ts}
        </div>
        <div class="content">
          {$golfers.email_address.$rowNumber}
        </div>
      </div>
      <br/>
      <div class="crm-section">
        <div class="label">
          {ts}Address{/ts}
        </div>
        <div class="content">
          {$golfers.street_address.$rowNumber}
        </div>
      </div>
      <div class="crm-section">
        <div class="label">
          {ts}City{/ts}
        </div>
        <div class="content">
          {$golfers.city.$rowNumber}
        </div>
      </div>
      <div class="crm-section">
        <div class="label">
          {ts}Postcode{/ts}
        </div>
        <div class="content">
          {$golfers.postal_code.$rowNumber}
        </div>
      </div>
      <div class="crm-section">
        <div class="label">
          {ts}Province{/ts}
        </div>
        <div class="content">
          {$golfers.state_province_id.$rowNumber}
        </div>
      </div>
      <div class="crm-section">
        <div class="label">
          {ts}Country{/ts}
        </div>
        <div class="content">
          {$golfers.country_id.$rowNumber}
        </div>
      </div>
      <div class="crm-section">
        <div class="label">
          {ts}Province{/ts}
        </div>
        <div class="content">
          {$golfers.state_province_id.$rowNumber}
        </div>
      </div>
    {/if}
    </fieldset>
  </div>
{/section}
</div>
</div>

{literal}
<script type="text/javascript">
  CRM.$(function($) {
    $('#multiplehonorees').insertAfter($('.event_fees-group'));
  });
</script>
{/literal}
