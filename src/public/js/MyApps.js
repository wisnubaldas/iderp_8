function Baldas(){
    let app = {
        view:{},
        controller:{},
        model:{}
    }
    app.view.input = function(p) {
        // const k = Object.keys(p.attr)
        const v = Object.entries(p.attr)
        const x = v.map(function (x) {
            return x[0]+'="'+x[1]+'"';
        })
        return `<div class="input-group m-b">
                    <div class="input-group-prepend">
                        <span class="input-group-addon">${p.addon}</span>
                    </div>
                    <input ${x.join(' ')} class="form-control">
                </div>`;
    }
    app.view.select = function(a,id,name)
    {
        const v = Object.entries(a)
        const x = v.map(function (x) {
            return `<option value="${x[0]}">${x[1]}</option>`;
        })
        return `
                    <select  width="100%" class="select2_demo_1 form-control" id="${id}" name="${name}">
                        ${x.join(' ')}
                    </select>
                `;
    },
    app.view.alert = function(status,message)
    {
        return `<br><div class="alert ${status} animated fadeIn">
                                            <i class="fa fa-paper-plane fa-2x"></i>
                                            <p>${message}</p>
                                        </div>`;
    }
    return app
}



