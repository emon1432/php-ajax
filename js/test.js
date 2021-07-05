var country = 'us';
var myCountry = 'Bangladesh';

function showCountry() {
    if (!myCountry) {
        console.log(myCountry);
        var myCountry = country;
    }
    console.log(myCountry);
    return myCountry;

}
console.log(myCountry);

console.log(showCountry());
console.log(myCountry);