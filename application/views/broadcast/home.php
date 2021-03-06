<?php $baseurl = base_url('assets/reactjs/'); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <link rel="icon" href="<?php echo $baseurl; ?>favicon.ico" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <meta
      name="description"
      content="This is the official site for Tacsfonui Chapter"
    />
    <link rel="apple-touch-icon" href="<?php echo $baseurl; ?>logo192.png" />
    <link rel="manifest" href="<?php echo $baseurl; ?>manifest.json" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link
      href="https://fonts.googleapis.com/css2?family=Encode+Sans+Expanded:wght@400;700;900&display=swap"
      rel="stylesheet"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Prata&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/lightgallery.js@1.2.0/dist/css/lightgallery.min.css"
    />
    <title>Tacsfonui Chapter</title>
    <link href="<?php echo $baseurl; ?>static/css/main.e436a337.chunk.css" rel="stylesheet" />
  </head>
  <body>
    <noscript>You need to enable JavaScript to run this app.</noscript>
    <div id="root"></div>
    <script>
      !(function (e) {
        function t(t) {
          for (
            var n, f, l = t[0], a = t[1], i = t[2], c = 0, s = [];
            c < l.length;
            c++
          )
            (f = l[c]),
              Object.prototype.hasOwnProperty.call(o, f) &&
                o[f] &&
                s.push(o[f][0]),
              (o[f] = 0);
          for (n in a)
            Object.prototype.hasOwnProperty.call(a, n) && (e[n] = a[n]);
          for (p && p(t); s.length; ) s.shift()();
          return u.push.apply(u, i || []), r();
        }
        function r() {
          for (var e, t = 0; t < u.length; t++) {
            for (var r = u[t], n = !0, l = 1; l < r.length; l++) {
              var a = r[l];
              0 !== o[a] && (n = !1);
            }
            n && (u.splice(t--, 1), (e = f((f.s = r[0]))));
          }
          return e;
        }
        var n = {},
          o = { 1: 0 },
          u = [];
        function f(t) {
          if (n[t]) return n[t].exports;
          var r = (n[t] = { i: t, l: !1, exports: {} });
          return e[t].call(r.exports, r, r.exports, f), (r.l = !0), r.exports;
        }
        (f.m = e),
          (f.c = n),
          (f.d = function (e, t, r) {
            f.o(e, t) ||
              Object.defineProperty(e, t, { enumerable: !0, get: r });
          }),
          (f.r = function (e) {
            "undefined" != typeof Symbol &&
              Symbol.toStringTag &&
              Object.defineProperty(e, Symbol.toStringTag, { value: "Module" }),
              Object.defineProperty(e, "__esModule", { value: !0 });
          }),
          (f.t = function (e, t) {
            if ((1 & t && (e = f(e)), 8 & t)) return e;
            if (4 & t && "object" == typeof e && e && e.__esModule) return e;
            var r = Object.create(null);
            if (
              (f.r(r),
              Object.defineProperty(r, "default", { enumerable: !0, value: e }),
              2 & t && "string" != typeof e)
            )
              for (var n in e)
                f.d(
                  r,
                  n,
                  function (t) {
                    return e[t];
                  }.bind(null, n)
                );
            return r;
          }),
          (f.n = function (e) {
            var t =
              e && e.__esModule
                ? function () {
                    return e.default;
                  }
                : function () {
                    return e;
                  };
            return f.d(t, "a", t), t;
          }),
          (f.o = function (e, t) {
            return Object.prototype.hasOwnProperty.call(e, t);
          }),
          (f.p = "/");
        var l = (this.webpackJsonptasfon = this.webpackJsonptasfon || []),
          a = l.push.bind(l);
        (l.push = t), (l = l.slice());
        for (var i = 0; i < l.length; i++) t(l[i]);
        var p = a;
        r();
      })([]);
    </script>
    <script src="<?php echo $baseurl; ?>static/js/2.cef1d93d.chunk.js"></script>
    <script src="<?php echo $baseurl; ?>static/js/main.5169139b.chunk.js"></script>
  </body>
</html>
