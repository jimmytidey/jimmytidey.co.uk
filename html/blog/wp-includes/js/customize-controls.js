(function(a,c){var b=wp.customize;b.Setting=b.Value.extend({initialize:function(g,f,d){var e;b.Value.prototype.initialize.call(this,f,d);this.id=g;this.method=this.method||"refresh";e=c("<input />",{type:"hidden",value:this.get(),name:b.settings.prefix+g});e.appendTo(this.previewer.form);this.element=new b.Element(e);this.sync(this.element);this.bind(this.preview)},preview:function(){switch(this.method){case"refresh":return this.previewer.refresh();case"postMessage":return this.previewer.send("setting",[this.id,this()])}}});b.Control=b.Class.extend({initialize:function(i,e){var g=this,d,h,f;this.params={};c.extend(this,e||{});this.id=i;this.selector="#customize-control-"+i.replace("]","").replace("[","-");this.container=c(this.selector);f=c.map(this.params.settings,function(j){return j});b.apply(b,f.concat(function(){var j;g.settings={};for(j in g.params.settings){g.settings[j]=b(g.params.settings[j])}g.setting=g.settings["default"]||null;g.ready()}));g.elements=[];d=this.container.find("[data-customize-setting-link]");h={};d.each(function(){var k=c(this),j;if(k.is(":radio")){j=k.prop("name");if(h[j]){return}h[j]=true;k=d.filter('[name="'+j+'"]')}b(k.data("customizeSettingLink"),function(m){var l=new b.Element(k);g.elements.push(l);l.sync(m);l.set(m())})});this.container.on("click",".dropdown",function(j){j.preventDefault();g.container.toggleClass("open")})},ready:function(){}});b.ColorControl=b.Control.extend({ready:function(){var e=this,d,f,g;d=this.container.find(".color-picker-spot");g=function(h){h="#"+h;d.css("background",h);e.farbtastic.setColor(h)};this.farbtastic=c.farbtastic(this.container.find(".farbtastic-placeholder"),function(h){e.setting.set(h.replace("#",""))});this.setting.bind(g);g(this.setting())}});b.UploadControl=b.Control.extend({ready:function(){var d=this;this.params.removed=this.params.removed||"";this.success=c.proxy(this.success,this);this.uploader=new wp.Uploader({browser:this.container.find(".upload"),dropzone:this.container.find(".upload-dropzone"),success:this.success});this.remover=this.container.find(".remove");this.remover.click(function(e){d.setting.set(d.params.removed);e.preventDefault()});this.removerVisibility=c.proxy(this.removerVisibility,this);this.setting.bind(this.removerVisibility);this.removerVisibility(this.setting.get());if(this.params.context){d.uploader.param("post_data[context]",this.params.context)}},success:function(d){this.setting.set(d.url)},removerVisibility:function(d){this.remover.toggle(d!=this.params.removed)}});b.ImageControl=b.UploadControl.extend({ready:function(){var e=this,d;b.UploadControl.prototype.ready.call(this);this.thumbnail=this.container.find(".preview-thumbnail img");this.thumbnailSrc=c.proxy(this.thumbnailSrc,this);this.setting.bind(this.thumbnailSrc);this.library=this.container.find(".library");this.tabs={};d=this.library.find(".library-content");this.library.children("ul").children("li").each(function(){var g=c(this),h=g.data("customizeTab"),f=d.filter('[data-customize-tab="'+h+'"]');e.tabs[h]={both:g.add(f),link:g,panel:f}});this.selected=this.tabs[d.first().data("customizeTab")];this.selected.both.addClass("library-selected");this.library.children("ul").on("click","li",function(g){var h=c(this).data("customizeTab"),f=e.tabs[h];g.preventDefault();if(f.link.hasClass("library-selected")){return}e.selected.both.removeClass("library-selected");e.selected=f;e.selected.both.addClass("library-selected")});this.library.on("click","a",function(f){var g=c(this).data("customizeImageValue");if(g){e.setting.set(g);f.preventDefault()}});if(this.tabs.uploaded){this.tabs.uploaded.target=this.library.find(".uploaded-target");if(!this.tabs.uploaded.panel.find(".thumbnail").length){this.tabs.uploaded.both.addClass("hidden")}}},success:function(d){b.UploadControl.prototype.success.call(this,d);if(this.tabs.uploaded&&this.tabs.uploaded.target.length){this.tabs.uploaded.both.removeClass("hidden");c('<a href="#" class="thumbnail"></a>').data("customizeImageValue",d.url).append('<img src="'+d.url+'" />').appendTo(this.tabs.uploaded.target)}},thumbnailSrc:function(d){if(/^(https?:)?\/\//.test(d)){this.thumbnail.prop("src",d).show()}else{this.thumbnail.hide()}}});b.defaultConstructor=b.Setting;b.control=new b.Values({defaultConstructor:b.Control});b.Previewer=b.Messenger.extend({refreshBuffer:250,initialize:function(f,e){var d=this;c.extend(this,e||{});this.loaded=c.proxy(this.loaded,this);this.loaderUuid=0;this.refresh=(function(g){var h=g.refresh,j=function(){i=null;h.call(g)},i;return function(){if(typeof i!=="number"){if(g.loading){g.loading.remove();delete g.loading;g.loader()}else{return j()}}clearTimeout(i);i=setTimeout(j,g.refreshBuffer)}})(this);this.iframe=b.ensure(f.iframe);this.form=b.ensure(f.form);this.name=this.iframe.prop("name");this.container=this.iframe.parent();b.Messenger.prototype.initialize.call(this,f.url,this.iframe[0].contentWindow);this._formOriginalProps={target:this.form.prop("target"),action:this.form.prop("action")};this.bind("url",function(g){if(this.url()==g||0!==g.indexOf(this.origin()+"/")||-1!==g.indexOf("wp-admin")){return}this.url(g);this.refresh()});this.refresh();this.form.on("keydown",function(g){if(13===g.which){g.preventDefault()}});this.parent=new b.Messenger(b.settings.parent);this.parent.bind("back",function(g){d.form.find(".back").text(g).click(function(h){h.preventDefault();d.parent.send("close")})});this.parent.send("ready")},loader:function(){if(this.loading){return this.loading}this.loading=c("<iframe />",{name:this.name+"-loading-"+this.loaderUuid++}).appendTo(this.container);return this.loading},loaded:function(){this.iframe.remove();this.iframe=this.loading;delete this.loading;this.iframe.prop("name",this.name);this.targetWindow(this.iframe[0].contentWindow)},refresh:function(){this.loader().one("load",this.loaded);this.submit({target:this.loader().prop("name"),action:this.url()})},submit:function(d){if(d){this.form.prop(d)}this.form.submit();if(d){this.form.prop(this._formOriginalProps)}}});b.controlConstructor={color:b.ColorControl,upload:b.UploadControl,image:b.ImageControl};c(function(){if(!b.settings){return}var d=c(document.body),e=new b.Previewer({iframe:"#customize-preview iframe",form:"#customize-controls",url:b.settings.preview});c.each(b.settings.settings,function(g,f){b.set(g,g,f.value,{previewer:e})});c.each(b.settings.controls,function(i,g){var f=b.controlConstructor[g.type]||b.Control,h;h=b.control.add(i,new f(i,{params:g,previewer:e}))});c(".customize-section-title").click(function(){c(this).parents(".customize-section").toggleClass("open");return false});c("#save").click(function(f){e.submit();f.preventDefault()});c(".collapse-sidebar").click(function(f){d.toggleClass("collapsed");f.preventDefault()});b("background_color",function(f){f.method="postMessage"});c.each({background_image:{controls:["background_repeat","background_position_x","background_attachment"],callback:function(f){return !!f}},show_on_front:{controls:["page_on_front","page_for_posts"],callback:function(f){return"page"===f}},header_textcolor:{controls:["header_textcolor"],callback:function(f){return"blank"!==f}}},function(f,g){b(f,function(h){c.each(g.controls,function(j,k){b.control(k,function(l){var i=function(m){l.container.toggle(g.callback(m))};i(h.get());h.bind(i)})})})});b.control("display_header_text",function(g){var f="";g.elements[0].unsync(b("header_textcolor"));g.element=new b.Element(g.container.find("input"));g.element.set("blank"!==g.setting());g.element.bind(function(h){if(!h){f=b.get("header_textcolor")}g.setting.set(h?f:"blank")});g.setting.bind(function(h){g.element.set("blank"!==h)})})})})(wp,jQuery);