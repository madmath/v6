{*
 * CubeCart v6
 * ========================================
 * CubeCart is a registered trade mark of CubeCart Limited
 * Copyright CubeCart Limited 2014. All rights reserved.
 * UK Private Limited Company No. 5323904
 * ========================================
 * Web:   http://www.cubecart.com
 * Email:  sales@devellion.com
 * License:  GPL-2.0 http://opensource.org/licenses/GPL-2.0
 *}
{if is_array($product.options)}
  {foreach from=$product.options item=option}
  {if $option.type == '0'}
  <div>
     <div>
        <label for="option_{$option.option_id}" class="return">{$option.option_name}{if $option.price} ({$option.symbol}{$option.price}){/if}{if $option.required} ({$LANG.common.required}){/if}</label>
        <span rel="{$product.id}">
        <select name="inv[{$product.id}][productOptions][{$option.option_id}]" id="option_{$option.option_id}" class="nomarg options_calc" {if $option.required}required{/if}>
           <option value="">{$LANG.form.please_select}</option>
           {foreach from=$option.values item=value}
           <option value="{$value.assign_id}"{if $value.selected} selected="selected"{/if} rel="{$value.symbol}{$value.decimal_price}">{$value.value_name}{if $value.price} ({$value.symbol}{$value.price}){/if}</option>
           {/foreach}
        </select>
        </span>
     </div>
  </div>
  {else}
  <div>
     <div>
        <label for="option_{$option.option_id}" class="return">{$option.option_name}{if $option.required}  ({$LANG.common.required}){/if}</label>
        <span rel="{$product.id}">
        {if $option.type == '1'}
        <input type="text" class="text_calc" placeholder="{if $option.price}({$option.symbol}{$option.price}){/if}" name="inv[{$product.id}][productOptions][{$option.option_id}][{$OPT.assign_id}]" id="option_{$option.option_id}" value="{$option.value}" rel="{$option.symbol}{$option.decimal_price}" {if $option.required}required{/if} >
        {elseif $option.type == '2'}
        <textarea  class="text_calc" name="inv[{$product.id}][productOptions][{$option.option_id}][{$OPT.assign_id}]" rel="{$option.symbol}{$option.decimal_price}" placeholder="{if $option.price}({$option.symbol}{$option.price}){/if}" id="option_{$option.option_id}" {if $option.required}required{/if}>{$option.value}</textarea>
        {/if}
        </span>
     </div>
  </div>
  {/if}
  {/foreach}
{/if}