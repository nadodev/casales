@php($network = strtolower(trim($platform)))
@if($network === 'instagram')
<svg viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="5"></rect><circle cx="12" cy="12" r="4"></circle><circle cx="17.5" cy="6.5" r="1" class="social-icon-fill"></circle></svg>
@elseif($network === 'whatsapp')
<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M20.5 11.7a8.5 8.5 0 0 1-12.6 7.5L3 20.5l1.3-4.7a8.5 8.5 0 1 1 16.2-4.1Z"></path><path d="M8.2 7.6c.2-.4.4-.4.7-.4h.5c.2 0 .4.1.5.4l.8 1.8c.1.3 0 .5-.2.7l-.6.7c-.2.2-.1.4 0 .6.7 1.2 1.7 2.2 3 2.8.2.1.4.1.6-.1l.8-1c.2-.2.4-.3.7-.2l1.8.9c.3.1.4.3.4.5 0 .3-.2 1.5-1 2.1-.7.6-1.6.8-2.6.5-1-.3-2.4-.8-4.1-2.3-1.4-1.2-2.4-2.8-2.7-3.8-.4-1-.1-2.4.4-3.2Z"></path></svg>
@elseif($network === 'facebook')
<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M14 21v-8h3l.5-3H14V8.2c0-.9.3-1.7 1.8-1.7H18V3.8c-.4-.1-1.7-.2-2.7-.2-2.7 0-4.5 1.6-4.5 4.6V10H8v3h2.8v8"></path></svg>
@elseif($network === 'linkedin')
<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5 9v11M5 5.5v.1M10 20V9m0 4.8c.8-3.1 7-3.4 7 1.1V20M3 9h4M3 20h4"></path></svg>
@elseif($network === 'youtube')
<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M21 12c0 3-.4 5-1 5.7-.8.8-4.5 1-8 1s-7.2-.2-8-1C3.4 17 3 15 3 12s.4-5 1-5.7c.8-.8 4.5-1 8-1s7.2.2 8 1c.6.7 1 2.7 1 5.7Z"></path><path d="m10 9 5 3-5 3Z"></path></svg>
@else
<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M10 14a5 5 0 0 0 7.5.5l2-2a5 5 0 0 0-7-7l-1.1 1.1M14 10a5 5 0 0 0-7.5-.5l-2 2a5 5 0 0 0 7 7l1.1-1.1"></path></svg>
@endif
