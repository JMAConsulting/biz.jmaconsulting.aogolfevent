<div id="multiplehonorees" class="crm-public-form-item crm-group custom_post_profile-group">
  <div class="crm-public-form-item crm-group">
{section name='i' start=1 loop=5}
  {assign var='rowNumber' value=$smarty.section.i.index}
  <div id="add-item-row-{$rowNumber}" class="honoree-row hiddenElement {cycle values="odd-row,even-row"}">
    <fieldset><legend>{ts}Participant {$rowNumber}{/ts}</legend>
    <div class="crm-section">
      <div class="label">
        {$form.golfer_first_name.$rowNumber.label}
      </div>
      <div class="content">
        {$form.golfer_first_name.$rowNumber.html}<br>
      </div>
    </div>
    <br/>
    <div class="crm-section">
      <div class="label">
        {$form.golfer_last_name.$rowNumber.label}
      </div>
      <div class="content">
        {$form.golfer_last_name.$rowNumber.html}
      </div>
    </div>
    {if $rowNumber > 1}
      <div class="crm-section">
        <div class="label">
          {$form.golfer_email_address.$rowNumber.label}
        </div>
        <div class="content">
          {$form.golfer_email_address.$rowNumber.html}
        </div>
      </div>
      <div class="crm-section">
        <div class="label">
          {$form.golfer_street_address.$rowNumber.label}
        </div>
        <div class="content">
          {$form.golfer_street_address.$rowNumber.html}
        </div>
      </div>
      <div class="crm-section">
        <div class="label">
          {$form.golfer_supplemental_address_1.$rowNumber.label}
        </div>
        <div class="content">
          {$form.golfer_supplemental_address_1.$rowNumber.html}
        </div>
      </div>
      <div class="crm-section">
        <div class="label">
          {$form.golfer_city.$rowNumber.label}
        </div>
        <div class="content">
          {$form.golfer_city.$rowNumber.html}
        </div>
      </div>
      <div class="crm-section">
        <div class="label">
          {$form.golfer_postal_code.$rowNumber.label}
        </div>
        <div class="content">
          {$form.golfer_postal_code.$rowNumber.html}
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
  // Change -none - text
  var dinnerticket = $('.event_participant_s_-content').find('input[value="0"]').attr('id');
  $('label[for="' + dinnerticket + '"]').html("<b>Dinner Tickets only</b>");
});
</script>
{/literal}
<div class="crm-section dinner_guests-section hiddenElement">

  <div class="label">
    {$form.dinner_guests.label}
  </div>
  <div class="content dinner_guests-content">
     <div class="description">{ts}Please enter the names of guests you will be bringing to dinner (one per line){/ts}</div>
    {$form.dinner_guests.html}
  </div>
  <div class="clear"></div>
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
  // Change -none - text
  var dinnerticket = $('.event_participant_s_-content').find('input[value="0"]').attr('id');
  $('label[for="' + dinnerticket + '"]').html("<b>Dinner Tickets only</b>");
});
</script>
{/literal}
<div class="crm-section dinner_guests-section hiddenElement">

  <div class="label">
    {$form.dinner_guests.label}
  </div>
  <div class="content dinner_guests-content">
     <div class="description">{ts}Please enter the names of guests you will be bringing to dinner (one per line){/ts}</div>
    {$form.dinner_guests.html}
  </div>
  <div class="clear"></div>
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
  // Change -none - text
  var dinnerticket = $('.event_participant_s_-content').find('input[value="0"]').attr('id');
  $('label[for="' + dinnerticket + '"]').html("<b>Dinner Tickets only</b>");
});
</script>
{/literal}
<div class="crm-section dinner_guests-section hiddenElement">

  <div class="label">
    {$form.dinner_guests.label}
  </div>
  <div class="content dinner_guests-content">
     <div class="description">{ts}Please enter the names of guests you will be bringing to dinner (one per line){/ts}</div>
    {$form.dinner_guests.html}
  </div>
  <div class="clear"></div>
</div>
