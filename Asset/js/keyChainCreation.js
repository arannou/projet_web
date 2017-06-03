document.addEventListener('DOMContentLoaded', function(){
    var availableKeys       = document.getElementById('availableKeys');
    var addKey              = document.getElementById('addKey');
    var returnKey           = document.getElementById('returnKey');
    var keyChain            = document.getElementById('keyChain');
    var selectedKeys        = document.getElementById('selectedKeys');
    var showKeyChainCreator = document.getElementById('showKeyChainCreator');
    var showKeyChainSelector = document.getElementById('showKeyChainSelector');
    var keyChainCreator     = document.getElementById('keyChainCreator');
    var keyChainSelector    = document.getElementById('keyChainSelector');
    var keychainSelection   = document.getElementById('keychainSelection');

    keyChainCreator.style.display = "none";
    showKeyChainCreator.addEventListener('click', function(){
        keyChainCreator.style.display  = "block";
        keyChainSelector.style.display = "none";
        keychainSelection.value = "creation";
    });

    showKeyChainSelector.addEventListener('click', function(){
        keyChainCreator.style.display  = "none";
        keyChainSelector.style.display = "block";
        keychainSelection.value = "selection";
    });

    var keys = [];
    addKey.addEventListener('click', function(){
        if(availableKeys.value.length > 0){
            keys.push(availableKeys.value);
            selectedKeys.value = JSON.stringify(keys);

            keyChain.innerHTML = "";
            for (var key in keys) {
                keyChain.innerHTML += "<option>"+keys[key]+"</option>";
            }

            console.log(JSON.stringify(keys));
        }
    });

    returnKey.addEventListener('click', function(){
        var index = keys.indexOf(keyChain.value);
        keys.splice(index, 1);

        keyChain.innerHTML = "";
        for (var key in keys) {
            keyChain.innerHTML += "<option>"+keys[key]+"</option>";
        }

        selectedKeys.value = JSON.stringify(keys);
        console.log(JSON.stringify(keys));
    });
});
