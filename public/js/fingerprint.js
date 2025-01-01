var __extends=this&&this.__extends||function(n,t){function r(){this.constructor=n}for(var i in t)t.hasOwnProperty(i)&&(n[i]=t[i]);n.prototype=t===null?Object.create(t):(r.prototype=t.prototype,new r)},Fingerprint;(function(n){function b(n){return n.length%4==2?n=n+"==":n.length%4==3&&(n=n+"="),n=n.replace(/-/g,"+"),n.replace(/_/g,"/")}function k(n){return n=n.replace(/\=/g,""),n=n.replace(/\+/g,"-"),n.replace(/\//g,"_")}function i(n){return window.atob(b(n))}function f(n){return k(window.btoa(n))}var d,g,nt,tt,it,e,c,l,r,a,v,y,p,w,t,u,o;n.b64UrlTo64=b;n.b64To64Url=k;n.b64UrlToUtf8=i;n.strToB64Url=f,function(n){n[n.Persistent=0]="Persistent";n[n.Volatile=1]="Volatile"}(n.DeviceUidType||(n.DeviceUidType={}));d=n.DeviceUidType,function(n){n[n.Unknown=0]="Unknown";n[n.Swipe=1]="Swipe";n[n.Area=2]="Area";n[n.AreaMultifinger=3]="AreaMultifinger"}(n.DeviceModality||(n.DeviceModality={}));g=n.DeviceModality,function(n){n[n.Unknown=0]="Unknown";n[n.Optical=1]="Optical";n[n.Capacitive=2]="Capacitive";n[n.Thermal=3]="Thermal";n[n.Pressure=4]="Pressure"}(n.DeviceTechnology||(n.DeviceTechnology={}));nt=n.DeviceTechnology,function(n){n[n.Raw=1]="Raw";n[n.Intermediate=2]="Intermediate";n[n.Compressed=3]="Compressed";n[n.PngImage=5]="PngImage"}(n.SampleFormat||(n.SampleFormat={}));tt=n.SampleFormat,function(n){n[n.Good=0]="Good";n[n.NoImage=1]="NoImage";n[n.TooLight=2]="TooLight";n[n.TooDark=3]="TooDark";n[n.TooNoisy=4]="TooNoisy";n[n.LowContrast=5]="LowContrast";n[n.NotEnoughFeatures=6]="NotEnoughFeatures";n[n.NotCentered=7]="NotCentered";n[n.NotAFinger=8]="NotAFinger";n[n.TooHigh=9]="TooHigh";n[n.TooLow=10]="TooLow";n[n.TooLeft=11]="TooLeft";n[n.TooRight=12]="TooRight";n[n.TooStrange=13]="TooStrange";n[n.TooFast=14]="TooFast";n[n.TooSkewed=15]="TooSkewed";n[n.TooShort=16]="TooShort";n[n.TooSlow=17]="TooSlow";n[n.ReverseMotion=18]="ReverseMotion";n[n.PressureTooHard=19]="PressureTooHard";n[n.PressureTooLight=20]="PressureTooLight";n[n.WetFinger=21]="WetFinger";n[n.FakeFinger=22]="FakeFinger";n[n.TooSmall=23]="TooSmall";n[n.RotatedTooMuch=24]="RotatedTooMuch"}(n.QualityCode||(n.QualityCode={}));it=n.QualityCode;e=function(){function n(n){this.type=n}return n}();n.Event=e;c=function(n){function t(t){n.call(this,t)}return __extends(t,n),t}(e);n.CommunicationEvent=c;l=function(n){function t(){n.call(this,"CommunicationFailed")}return __extends(t,n),t}(c);n.CommunicationFailed=l;r=function(n){function t(t,i){n.call(this,t);this.deviceUid=i}return __extends(t,n),t}(e);n.AcquisitionEvent=r;a=function(n){function t(t){n.call(this,"DeviceConnected",t)}return __extends(t,n),t}(r);n.DeviceConnected=a;v=function(n){function t(t){n.call(this,"DeviceDisconnected",t)}return __extends(t,n),t}(r);n.DeviceDisconnected=v;y=function(n){function t(t,i,r){n.call(this,"SamplesAcquired",t);this.sampleFormat=i;this.samples=r}return __extends(t,n),t}(r);n.SamplesAcquired=y;p=function(n){function t(t,i){n.call(this,"QualityReported",t);this.quality=i}return __extends(t,n),t}(r);n.QualityReported=p;w=function(n){function t(t,i){n.call(this,"ErrorOccurred",t);this.error=i}return __extends(t,n),t}(r);n.ErrorOccurred=w,function(n){n[n.EnumerateDevices=1]="EnumerateDevices";n[n.GetDeviceInfo=2]="GetDeviceInfo";n[n.StartAcquisition=3]="StartAcquisition";n[n.StopAcquisition=4]="StopAcquisition"}(t||(t={})),function(n){n[n.Completed=0]="Completed";n[n.Error=1]="Error";n[n.Disconnected=2]="Disconnected";n[n.Connected=3]="Connected";n[n.Quality=4]="Quality"}(u||(u={})),function(n){n[n.Response=0]="Response";n[n.Notification=1]="Notification"}(o||(o={}));var s=function(){function n(n,t){this.Method=n;t&&(this.Parameters=t)}return n}(),h=function(){function n(n,t,i){this.command=n;this.resolve=t;this.reject=i;this.sent=!1}return n}(),rt=function(){function n(){this.webChannel=new WebSdk.WebChannelClient("fingerprints");this.requests=[];this.handlers={};this.connected=!1;this.onDeviceConnected=null;this.onDeviceDisconnected=null;this.onSamplesAcquired=null;this.onQualityReported=null;this.onErrorOccurred=null;this.onCommunicationFailed=null;var n=this;this.webChannel.onConnectionSucceed=function(){n.onConnectionSucceed()};this.webChannel.onConnectionFailed=function(){n.onConnectionFailed()};this.webChannel.onDataReceivedTxt=function(t){n.onDataReceivedTxt(t)}}return n.prototype.enumerateDevices=function(){var n=this;return new Promise(function(i,r){var u=new s(t.EnumerateDevices),f=new h(u,i,r);n.requests.push(f);n.connected?n.processQueue():n.webChannel.connect()})},n.prototype.getDeviceInfo=function(n){var i=this;return new Promise(function(r,u){var e={DeviceID:n},o=new s(t.GetDeviceInfo,f(JSON.stringify(e))),c=new h(o,r,u);i.requests.push(c);i.connected?i.processQueue():i.webChannel.connect()})},n.prototype.startAcquisition=function(n,i){var r=this;return new Promise(function(u,e){var o={DeviceID:i?i:"00000000-0000-0000-0000-000000000000",SampleType:n},c=new s(t.StartAcquisition,f(JSON.stringify(o))),l=new h(c,u,e);r.requests.push(l);r.connected?r.processQueue():r.webChannel.connect()})},n.prototype.stopAcquisition=function(n){var i=this;return new Promise(function(r,u){var e={DeviceID:n?n:"00000000-0000-0000-0000-000000000000"},o=new s(t.StopAcquisition,f(JSON.stringify(e))),c=new h(o,r,u);i.requests.push(c);i.connected?i.processQueue():i.webChannel.connect()})},n.prototype.onConnectionSucceed=function(){this.connected=!0;this.processQueue()},n.prototype.onConnectionFailed=function(){this.connected=!1;for(var n=0;n<this.requests.length;n++)this.requests[n].reject(new Error("Communication failure."));this.requests=[];this.emit(new l)},n.prototype.onDataReceivedTxt=function(n){var t=JSON.parse(i(n)),r,u;t.Type===o.Response?(r=JSON.parse(i(t.Data)),this.processResponse(r)):t.Type===o.Notification&&(u=JSON.parse(i(t.Data)),this.processNotification(u))},n.prototype.processQueue=function(){for(var n=0;n<this.requests.length;n++)this.requests[n].sent||(this.webChannel.sendDataTxt(f(JSON.stringify(this.requests[n].command))),this.requests[n].sent=!0)},n.prototype.processResponse=function(n){for(var f,e,r,u=0;u<this.requests.length;u++)if(this.requests[u].sent&&this.requests[u].command.Method===n.Method){r=this.requests[u];this.requests.splice(u,1);break}r&&(n.Method===t.EnumerateDevices?n.Result<0?r.reject(new Error("EnumerateDevices: "+(n.Result>>>0).toString(16))):(f=JSON.parse(i(n.Data)),r.resolve(JSON.parse(f.DeviceIDs))):n.Method===t.GetDeviceInfo?n.Result<0?r.reject(new Error("GetDeviceInfo: "+(n.Result>>>0).toString(16))):(e=JSON.parse(i(n.Data)),r.resolve(e)):n.Method===t.StartAcquisition?n.Result<0?r.reject(new Error("StartAcquisition: "+(n.Result>>>0).toString(16))):r.resolve():n.Method===t.StopAcquisition&&(n.Result<0?r.reject(new Error("StopAcquisition: "+(n.Result>>>0).toString(16))):r.resolve()))},n.prototype.processNotification=function(n){var t,r,f;n.Event===u.Completed?(t=JSON.parse(i(n.Data)),this.emit(new y(n.Device,t.SampleFormat,t.Samples))):n.Event===u.Connected?this.emit(new a(n.Device)):n.Event===u.Disconnected?this.emit(new v(n.Device)):n.Event===u.Error?(r=JSON.parse(i(n.Data)),this.emit(new w(n.Device,r.uError))):n.Event===u.Quality&&(f=JSON.parse(i(n.Data)),this.emit(new p(n.Device,f.Quality)))},n.prototype.on=function(n,t){return this.handlers[n]||(this.handlers[n]=[]),this.handlers[n].push(t),this},n.prototype.off=function(n,t){if(n){var i=this.handlers[n];i&&(t?this.handlers[n]=i.filter(function(n){return n!==t}):delete this.handlers[n])}else this.handlers={};return this},n.prototype.emit=function(n){var u=this,t,i,r;n&&(t=n.type,i=this["on"+t],i&&this.invoke(i,n),r=this.handlers[t],r&&r.forEach(function(t){return u.invoke(t,n)}))},n.prototype.invoke=function(n,t){try{n(t)}catch(i){console.error(i)}},n}();n.WebApi=rt})(Fingerprint||(Fingerprint={}));
//# sourceMappingURL=fingerprint.sdk.min.js.map
