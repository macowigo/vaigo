(function(d) { "function" === typeof define && define.amd ? define(["jquery", "datatables.net", "datatables.net-buttons"], function(f) { return d(f, window, document) }) : "object" === typeof exports ? module.exports = function(f, b) { f || (f = window); if (!b || !b.fn.dataTable) b = require("datatables.net")(f, b).$;
        b.fn.dataTable.Buttons || require("datatables.net-buttons")(f, b); return d(b, f, f.document) } : d(jQuery, window, document) })(function(d, f, b) {
    var i = d.fn.dataTable,
        h = b.createElement("a"),
        m = function(a) {
            h.href = a;
            a = h.host; - 1 === a.indexOf("/") &&
                0 !== h.pathname.indexOf("/") && (a += "/");
            return h.protocol + "//" + a + h.pathname + h.search
        };
    i.ext.buttons.print = {
        className: "buttons-print",
        text: function(a) { return a.i18n("buttons.print", "Print") },
        action: function(a, b, h, e) {
            var c = b.buttons.exportData(e.exportOptions),
                k = function(a, c) { for (var b = "<tr>", d = 0, e = a.length; d < e; d++) b += "<" + c + ">" + a[d] + "</" + c + ">"; return b + "</tr>" },
                a = '<table class="' + b.table().node().className + '">';
            e.header && (a += "<thead>" + k(c.header, "th") + "</thead>");
            for (var a = a + "<tbody>", l = 0, i = c.body.length; l <
                i; l++) a += k(c.body[l], "td");
            a += "</tbody>";
            e.footer && c.footer && (a += "<tfoot>" + k(c.footer, "th") + "</tfoot>");
            var g = f.open("", ""),
                c = e.title;
            "function" === typeof c && (c = c()); - 1 !== c.indexOf("*") && (c = c.replace("*", d("title").text()));
            g.document.close();
            var j = "<title>" + c + "</title>";
            d("style, link").each(function() { var a = j,
                    b = d(this).clone()[0]; "link" === b.nodeName.toLowerCase() && (b.href = m(b.href));
                j = a + b.outerHTML });
            try { g.document.head.innerHTML = j } catch (n) { d(g.document.head).html(j) }
            g.document.body.innerHTML = "<h1>" +
                c + "</h1><div>" + ("function" === typeof e.message ? e.message(b, h, e) : e.message) + "</div>" + a;
            d(g.document.body).addClass("dt-print-view");
            d("img", g.document.body).each(function(a, b) { b.setAttribute("src", m(b.getAttribute("src"))) });
            e.customize && e.customize(g);
            setTimeout(function() { e.autoPrint && (g.print(), g.close()) }, 250)
        },
        title: "*",
        message: "",
        exportOptions: {},
        header: !0,
        footer: !1,
        autoPrint: !0,
        customize: null
    };
    return i.Buttons
});