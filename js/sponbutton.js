(function() {
    tinymce.create("tinymce.plugins.disc_spon_plugin", {

        //url argument holds the absolute url of our plugin directory
        init : function(ed, url) {

            //add new button     
            ed.addButton("disclaimer", {
		
                title : "Sponsor Disclaimer",
                cmd : "spondisc",
                image : url + "/spnsr.png"
            });

            //button functionality.
            ed.addCommand("spondisc", function() {
                var selected_text = ed.selection.getContent();
                var return_text = "<i>Disclaimer: This post was sponsored by " + selected_text + " in a partnership with " + blg_name.name + " to provide you the most up to date facts, helping you make better informed decisions. All opinions in this article are my own.</i>";
                ed.execCommand("mceInsertContent", 0, return_text);
            });
        },

        createControl : function(n, cm) {
            return null;
        },

        getInfo : function() {
            return {
                longname : "Sponsor Disclaimer",
                author : "Aeryn Lynne",
                version : "1"
            };
        }
    });

    tinymce.PluginManager.add("disc_spon_plugin", tinymce.plugins.disc_spon_plugin);
})();