function test(num1, num2){
    const objLit = {
        name: 'samin',
        age: 10,
        favoriteColor: ['red','black'],
        wife: {
            name: 'suva',
            age: 18,
            favoriteColor: ['blue','violet']
        }
    }
    const arr = ['this', 'is', 'string', 10, null];
    const tmp = `Numbers are ${num1} ${num2}`;
    return objLit;
}
const tmp = test(1,3);
if(tmp.favoriteColor[1] === 'black'){
    console.log('this is if');
}else{
    console.log('this is else');
}

const secondExp = {
    name: 'samin',
    age: 10,
    favoriteColor: ['red','black'],
    wife: {
        name: 'suva',
        age: 18,
        favoriteColor: ['blue','violet']
    }
}

console.log(secondExp);

const {name, age} = secondExp;

secondExp.profession = 'Executive';

console.log(secondExp);

const todo = [
    {
        time: 10,
        jobs: 5,
        name: 'ron'
    },
    {
        time: 2,
        jobs: 5,
        name: 'gabe'
    },
    {
        time: 10,
        jobs: 5,
        name: 'ron'
    }
];

const todoJSON = JSON.stringify(todo);

console.log(todo.length)

$('#myName').change(function (){
        let html = '';
        let name = $('#myName').val();
        let nums = Array.from(name.split(' '),Number);
        nums.sort(function(a, b){return a-b});
        console.log(nums);
        html += '<p>';
        nums.forEach(element => html += element+' ');
        html += '</p>';
        document.getElementById('checkName').innerHTML = html;
        // if(name === 'samin'){
        //     html += '<p>nums</p>';
        // }else{
        //     html += '<p>You are someone else</p>';
        // }
        // $('#testInput').val('This is a test');
        // $('#checkName').append(html);
    }
);