(()=>{"use strict";var e,o={934:()=>{const e=window.wp.blocks,o=window.React,l=window.wp.blockEditor,t=window.wp.components;(0,e.registerBlockType)("vitos/myblock",{edit:function({attributes:e,setAttributes:r}){const{text:n,align:a,color:c,backgroundColor:i}=e,s=e=>{r({text:e})};return(0,o.createElement)(o.Fragment,null,(0,o.createElement)(l.InspectorControls,null,(0,o.createElement)(t.PanelBody,{title:"Content",initialOpen:!0},(0,o.createElement)(t.TextControl,{label:"Title",value:n,help:"Inseret Title TextControl",onChange:s}),(0,o.createElement)(t.TextareaControl,{label:"Title",value:n,help:"Inseret Title",onChange:s}),(0,o.createElement)(t.ColorPicker,{label:"Text Color",color:c,onChange:e=>{r({color:e})},value:n,enableAlpha:!0}),(0,o.createElement)(t.ColorPalette,{label:"Background Color",colors:[{name:"gray",color:"#f5f5f5"},{name:"black",color:"#000"}],value:i,onChange:e=>{r({backgroundColor:e})}}),(0,o.createElement)(t.ToggleControl,{label:"Yes or No",checked:!0}))),(0,o.createElement)(l.BlockControls,null,(0,o.createElement)(l.AlignmentToolbar,{value:a,onChange:e=>r({align:e})})),(0,o.createElement)(l.RichText,{...(0,l.useBlockProps)({className:`vitos-align-${a}`,style:{color:c,backgroundColor:i}}),tagName:"h1",value:n,onChange:s,placeholder:"Введите заголовок",allowedFormats:[]}))},save:function({attributes:e}){const{text:t,align:r,color:n,backgroundColor:a}=e;return(0,o.createElement)(l.RichText.Content,{...l.useBlockProps.save({className:`vitos-align-${r}`,style:{color:n,backgroundColor:a}}),tagName:"h1",value:t})}})}},l={};function t(e){var r=l[e];if(void 0!==r)return r.exports;var n=l[e]={exports:{}};return o[e](n,n.exports,t),n.exports}t.m=o,e=[],t.O=(o,l,r,n)=>{if(!l){var a=1/0;for(u=0;u<e.length;u++){for(var[l,r,n]=e[u],c=!0,i=0;i<l.length;i++)(!1&n||a>=n)&&Object.keys(t.O).every((e=>t.O[e](l[i])))?l.splice(i--,1):(c=!1,n<a&&(a=n));if(c){e.splice(u--,1);var s=r();void 0!==s&&(o=s)}}return o}n=n||0;for(var u=e.length;u>0&&e[u-1][2]>n;u--)e[u]=e[u-1];e[u]=[l,r,n]},t.o=(e,o)=>Object.prototype.hasOwnProperty.call(e,o),(()=>{var e={57:0,350:0};t.O.j=o=>0===e[o];var o=(o,l)=>{var r,n,[a,c,i]=l,s=0;if(a.some((o=>0!==e[o]))){for(r in c)t.o(c,r)&&(t.m[r]=c[r]);if(i)var u=i(t)}for(o&&o(l);s<a.length;s++)n=a[s],t.o(e,n)&&e[n]&&e[n][0](),e[n]=0;return t.O(u)},l=globalThis.webpackChunkmyblock=globalThis.webpackChunkmyblock||[];l.forEach(o.bind(null,0)),l.push=o.bind(null,l.push.bind(l))})();var r=t.O(void 0,[350],(()=>t(934)));r=t.O(r)})();