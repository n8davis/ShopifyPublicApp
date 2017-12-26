ShopifyApp.init({
    apiKey: "", // add your own app api key
    shopOrigin: "", // add the client shop here 
    debug: false,
    forceRedirect: true
});

ShopifyApp.Bar.initialize({
    buttons: {
        primary: {
            label: "Save",
            message: 'bar_save'
        },
        secondary: [
            { label: "Help", callback: function(){ alert('help'); } },
            { label: "More",
                type: "dropdown",
                links: [
                    { label: "Update", href: "/update", target: "app" },
                    { label: "Delete", callback: function(){ alert("destroy") } }
                ]
            },
            { label: "Preview", href: "http://my-app.com/preview_url", target: "new" }
        ]
    },
    title: 'Page Title',
    icon: '',
    pagination: {
        next: {
            href: "/posts?page=2"
        },
        previous: {
            callback: function(){ alert('no previous pages') },
            loading: false
        }
    },
    breadcrumb: {
        label: "Subsection",
        href: "/subsection",
        target: 'app',
        loading: false
    }
});