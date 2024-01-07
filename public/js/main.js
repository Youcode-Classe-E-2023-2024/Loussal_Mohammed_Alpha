/* constants */
const URLROOT = 'http://localhost/HAMZA.MESKI.Alpha';

/* functions */ 
function deletePost(id){
    fetch('https://jsonplaceholder.typicode.com/posts/' + id, {
        method: 'DELETE', 
        headers: {
            'Content-Type': 'application/json',
        }
    })
    .then(res => {
        if(res.status == 200) {
            console.log(res.status);
            Swal.fire({
                position: "center",
                icon: "success",
                title: "Post deleted successfully",
                showConfirmButton: false,
                timer: 1500
              });
        }
    })
}

function deleteUser(id){
    fetch('https://jsonplaceholder.typicode.com/users/' + id, {
        method: 'DELETE', 
        headers: {
            'Content-Type': 'application/json',
        }
    })
    .then(res => {
        if(res.status == 200) {
            console.log(res.status);
            Swal.fire({
                position: "center",
                icon: "success",
                title: "User deleted successfully",
                showConfirmButton: false,
                timer: 1500
        });
        }
    })
}

// home controller
const home = document.getElementById('home'); 
if(home){
    fetch('https://jsonplaceholder.typicode.com/posts')
    .then(res => res.json())
    .then(data => {
        let html = '';
        for(let i = 0; i < data.length; i++){
            html += `
                <!-- component -->
                <div class="max-w-4xl px-10 my-4 py-6 bg-white rounded-lg shadow-md">
                    <div class="flex justify-between items-center">
                        <span class="font-light text-gray-600">mar 10, 2019</span>
                        <a class="px-2 py-1 bg-gray-600 text-gray-100 font-bold rounded hover:bg-gray-500" href="#">${data[i].id}</a>
                    </div>
                    <div class="mt-2">
                        <h1 class="text-2xl text-gray-700 font-bold hover:text-gray-600">${data[i].title}</h1>
                        <p class="mt-2 text-gray-600">${data[i].body}</p>
                    </div>
                    <div class="flex justify-between items-center mt-4">
                        <a class="text-blue-600 hover:underline" href="#">Read more</a>
                        <div>
                            <a class="flex items-center" href="#">
                                <img class="mx-4 w-10 h-10 object-cover rounded-full hidden sm:block" src="https://images.unsplash.com/photo-1502980426475-b83966705988?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=373&q=80" alt="avatar">
                                <h1 class="text-gray-700 font-bold">Khatab wedaa</h1>
                            </a>
                        </div>
                    </div>
                </div>
            `;
        }
        home.innerHTML = html;
    })
}

// dashboard controller 
const dashboard_index = document.getElementById('dashboard_index'); 
if(dashboard_index){
    // detecting numbers of users and posts on the plateform
    const users_number = document.getElementById('users_number');
    const posts_number = document.getElementById('posts_number');

    fetch('https://jsonplaceholder.typicode.com/posts')
    .then(res => res.json())
    .then(data => posts_number.textContent = data.length);

    fetch('https://jsonplaceholder.typicode.com/users')
    .then(res => res.json())
    .then(data => users_number.textContent = data.length);

    /************ Fetch users and posts data ***************/
    const usersPromise = fetch('https://jsonplaceholder.typicode.com/users').then(response => response.json());
    const postsPromise = fetch('https://jsonplaceholder.typicode.com/posts').then(response => response.json());
    
    /************ graph1  **************/
    Promise.all([usersPromise, postsPromise])
        .then(([users, posts]) => {
            // Create a mapping of user IDs to post counts
            const userPostCount = {};
            posts.forEach(post => {
                if (userPostCount[post.userId]) {
                    userPostCount[post.userId]++;
                } else {
                    userPostCount[post.userId] = 1;
                }
            });

            // Extract relevant data for the plot
            const usernames = users.map(user => user.username);
            const postCounts = usernames.map(username => userPostCount[users.find(user => user.username === username).id] || 0);

            // Create a bar chart using Plotly
            const trace = {
                x: usernames,
                y: postCounts,
                type: 'bar',
                text: postCounts.map(String),
                textposition: 'auto',
                marker: {
                    color: 'rgb(158,202,225)',
                    opacity: 0.7,
                    line: {
                        color: 'rgb(8,48,107)',
                        width: 1.5
                    }
                }
            };

            const layout = {
                title: 'Number of Posts per User',
                xaxis: {
                    title: 'Usernames'
                },
                yaxis: {
                    title: 'Number of Posts'
                }
            };

            const config = { responsive: true };

            // Plot the chart
            Plotly.newPlot('chart1', [trace], layout, config);
        })
        .catch(error => console.error('Error fetching data:', error));
    
        /***********************  graph2  ************************/
        Promise.all([usersPromise, postsPromise])
           .then(([users, posts]) => {
               // Create a mapping of user IDs to post counts
               const userPostCount = {};
               posts.forEach(post => {
                   if (userPostCount[post.userId]) {
                       userPostCount[post.userId]++;
                   } else {
                       userPostCount[post.userId] = 1;
                   }
               });

               // Extract relevant data for the pie chart
               const usernames = users.map(user => user.username);
               const postCounts = usernames.map(username => userPostCount[users.find(user => user.username === username).id] || 0);

               // Create a pie chart using Plotly
               const trace = {
                   labels: usernames,
                   values: postCounts,
                   type: 'pie',
                   textinfo: 'percent+label',
                   insidetextorientation: 'radial'
               };

               const layout = {
                   title: 'Distribution of Posts Among Users'
               };

               const config = { responsive: true };

               // Plot the chart
               Plotly.newPlot('chart2', [trace], layout, config);
           })
           .catch(error => console.error('Error fetching data:', error));
}

// managePost controller 
const managePosts_index = document.getElementById('managePosts_index');

if(managePosts_index){
    $(document).ready(function(){
        // Initialize DataTable
        $('#postsTable').DataTable({
            "ajax": {
                "url": "https://jsonplaceholder.typicode.com/posts",
                "dataSrc": "",
                // "data": formData,
                "type": 'GET',
            },
            "columns": [
                {"data": "id"},
                {"data": "userId"},
                {"data": "title"},
                {"data": "body"},
                {
                    data: 'id',
                    render: function(data) {
                        return `<button onclick="deletePost(${data})" name="btn" class="text-red-500 hover:underline mr-2">delete</button>` +
                            `<a href="${URLROOT}/ManagePosts/editPost/${data}" class="delete_btn text-blue-500 hover:underline focus:outline-none focus:ring focus:border-red-300" data-id="' + data + '">edit</a>`;
                    }
                }
            ]
        }); 
    });
}

// add post section 
const add_post_section = document.getElementById('add_post_section'); 
if(add_post_section){
    const add_button = document.getElementById('add_button'); 
    const apsection = document.getElementById('apsection');
    add_button.addEventListener('click', function(event){
        event.preventDefault(); 
        html = `  <div class="mb-4">
                                <label for="title" class="block text-gray-600">Title: *</label>
                                <input id="title_input" type="text" name="title" value="" 
                                    class="mt-1 p-2 w-full border rounded-md" required>
                                <span class="text-red-500"> </span>
                            </div>
                            <div class="mb-4">
                                <label for="body" class="block text-gray-600">Body: *</label>
                                <textarea id="body_input" name="body"
                                    class="mt-1 p-2 w-full border rounded-md" required></textarea>
                                <span class="text-red-500">  </span>
                            </div>`;
    apsection.insertAdjacentHTML('beforeend', html);
    })

    // 
    
    const add_post_form = document.getElementById('add_post_form'); 
    if(add_post_form){
        add_post_form.addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(this);
            fetch('https://jsonplaceholder.typicode.com/posts', {
                method: 'POST', 
                body : formData
            })
            .then(res=>{
                res.json()
                if(res.ok==true){
                    console.log(res.ok)
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Posts added successfully",
                        showConfirmButton: false,
                        timer: 1500
                      });
                }
            })
        })
    }
}

// manageUsers controller 
const manageUsers_index = document.getElementById('manageUsers_index'); 
if(manageUsers_index){
    $(document).ready(function(){
        // Initialize DataTable
        $('#usersTable').DataTable({
            "ajax": {
                "url": "https://jsonplaceholder.typicode.com/users",
                "dataSrc": "",
                // "data": formData,
                "type": 'GET',
            },
            "columns": [
                {"data": "id"},
                {"data": "username"},
                {"data": "email"},
                {"data": "phone"},
                {
                    data: 'id',
                    render: function(data) {
                        return `<button onclick="deleteUser(${data})" name="btn" class="text-red-500 hover:underline mr-2">delete</button>` +
                            `<a href="${URLROOT}/ManageUsers/editUser/${data}" class="delete_btn text-blue-500 hover:underline focus:outline-none focus:ring focus:border-red-300" data-id="' + data + '">edit</a>`;
                    }
                }
            ]
        }); 
    });

    // download users table as PDF format 
    document.getElementById('downloadPdf').addEventListener('click', () => {
        const element = document.getElementById('usersTable');

        html2pdf(element);
    });
}

// add user section 
const add_user_section = document.getElementById('add_user_section'); 
if(add_user_section){
    console.log(add_user_section);
    const add_button = document.getElementById('add_button'); 
    const apsection = document.getElementById('apsection');
    console.log(add_button);
    add_button.addEventListener('click', function(event){
        event.preventDefault(); 
        html = `<div class="mb-4">
                    <label for="username" class="block text-gray-600">username: *</label>
                    <input type="text" name="username" value="" 
                        class="mt-1 p-2 w-full border rounded-md">
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-gray-600">email: *</label>
                    <input type="text" name="email" value="" 
                        class="mt-1 p-2 w-full border rounded-md">
                </div>
                <div class="mb-4">
                    <label for="phone" class="block text-gray-600">phone: *</label>
                    <input type="number" name="phone" value="" 
                        class="mt-1 p-2 w-full border rounded-md">
                </div>`;
        apsection.insertAdjacentHTML('beforeend', html);
    })
    const add_user_form = document.getElementById('add_user_form'); 
    console.log(add_user_form);
    if(add_user_form){
        add_user_form.addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(this);
            fetch('https://jsonplaceholder.typicode.com/users', {
                method: 'POST', 
                body : formData
            })
            .then(res=>{
                res.json()
                if(res.ok==true){
                    console.log(res.ok)
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Users added successfully",
                        showConfirmButton: false,
                        timer: 1500
                      });
                }
            })
        })
    }
}