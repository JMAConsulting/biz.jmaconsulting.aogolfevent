<div id="splitreceipt">
    <div class="label">{$form.is_split_receipt.label}</div>
    <div class="content">{$form.is_split_receipt.html}</div>
    <div class="clear"></div>
</div>

{literal}
    <script type="text/javascript">
        CRM.$(function($) {
            $('#splitreceipt').insertBefore($('#pricesetTotal'));
        });
    </script>
{/literal}