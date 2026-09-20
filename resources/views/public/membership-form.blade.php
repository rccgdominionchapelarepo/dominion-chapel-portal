<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Church Membership Details Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-center mb-2">CHURCH MEMBERSHIP DETAILS FORM</h2>
        <p class="text-center text-gray-600 mb-8">Welcome! We are so blessed to have you as part of our church family. Please fill out this form for yourself and your family members.</p>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded mb-6">{{ session('success') }}</div>
        @endif

        <form action="{{ route('membership.store') }}" method="POST">
            @csrf
            
            <!-- FAMILY / PRIMARY CONTACT -->
            <h3 class="text-xl font-semibold border-b pb-2 mb-4">1. Family / Household Contact Details</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div>
                    <label class="block font-medium">Family Name (Surname)</label>
                    <input type="text" name="family_name" required class="w-full border p-2 rounded mt-1">
                </div>
                <div>
                    <label class="block font-medium">Family Email Address <span class="text-red-500">*</span></label>
                    <input type="email" name="email" required class="w-full border p-2 rounded mt-1">
                </div>
                <div>
                    <label class="block font-medium">Primary Phone Number</label>
                    <input type="text" name="phone_number" class="w-full border p-2 rounded mt-1">
                </div>
                <div>
                    <label class="block font-medium">Home Address</label>
                    <input type="text" name="home_address" class="w-full border p-2 rounded mt-1">
                </div>
                <div>
                    <label class="block font-medium">Emergency Contact Name</label>
                    <input type="text" name="emergency_contact_name" class="w-full border p-2 rounded mt-1">
                </div>
                <div>
                    <label class="block font-medium">Emergency Contact Phone</label>
                    <input type="text" name="emergency_contact_phone" class="w-full border p-2 rounded mt-1">
                </div>
            </div>

            <!-- INDIVIDUAL MEMBERS -->
            <h3 class="text-xl font-semibold border-b pb-2 mb-4 mt-8">2. Individual Family Members</h3>
            <div id="members-container">
                <!-- Member Template Block -->
                <div class="member-block bg-gray-50 p-4 border rounded mb-4" data-index="0">
                    <h4 class="font-bold mb-3 member-title">Member 1 (Head of Household / Single Individual)</h4>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block font-medium">Full Legal Name <span class="text-red-500">*</span></label>
                            <input type="text" name="members[0][full_name]" required class="w-full border p-2 rounded mt-1">
                        </div>
                        <div>
                            <label class="block font-medium">Preferred Name</label>
                            <input type="text" name="members[0][preferred_name]" class="w-full border p-2 rounded mt-1">
                        </div>
                        <div>
                            <label class="block font-medium">Date of Birth (Optional)</label>
                            <input type="date" name="members[0][dob]" class="w-full border p-2 rounded mt-1">
                        </div>
                        <div>
                            <label class="block font-medium">Gender</label>
                            <select name="members[0][gender]" class="w-full border p-2 rounded mt-1">
                                <option value="">Select...</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div>
                            <label class="block font-medium">Marital Status</label>
                            <select name="members[0][marital_status]" class="w-full border p-2 rounded mt-1">
                                <option value="">Select...</option>
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Widowed">Widowed</option>
                            </select>
                        </div>
                        <div>
                            <label class="block font-medium">Church Group <span class="text-red-500">*</span></label>
                            <select name="members[0][church_group]" required class="w-full border p-2 rounded mt-1">
                                <option value="">Select...</option>
                                <option value="Excellent Men">Excellent Men</option>
                                <option value="Good Women">Good Women</option>
                                <option value="Youth">Youth</option>
                                <option value="Teenagers">Teenagers</option>
                                <option value="Children">Children</option>
                            </select>
                        </div>
                        <div>
                            <label class="block font-medium">Membership Status</label>
                            <select name="members[0][membership_status]" class="w-full border p-2 rounded mt-1">
                                <option value="">Select...</option>
                                <option value="New Visitor">New Visitor</option>
                                <option value="Regular">Regular</option>
                                <option value="Transferring">Transferring</option>
                            </select>
                        </div>
                        <div>
                            <label class="block font-medium">Water Baptism</label>
                            <select name="members[0][water_baptism]" class="w-full border p-2 rounded mt-1">
                                <option value="">Select...</option>
                                <option value="Baptized">Baptized</option>
                                <option value="Interested">Interested</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <label class="block font-medium mb-2">Unit in Church (Optional) </label>
                        <input type="text" 
                            name="members[0][areas_to_serve]" 
                            placeholder="e.g. Choir, Ushering, Media, Children's Teacher" 
                            class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    </div>
                </div>
            </div>

            <button type="button" id="add-member-btn" class="bg-blue-100 text-blue-700 px-4 py-2 rounded font-medium mt-2 hover:bg-blue-200">
                + Add Another Family Member
            </button>

            <div class="mt-8 text-center border-t pt-6">
                <button type="submit" class="bg-green-600 text-white px-8 py-3 rounded-lg font-bold hover:bg-green-700 text-lg">
                    Submit Membership Details
                </button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('add-member-btn').addEventListener('click', function() {
            const container = document.getElementById('members-container');
            const blocks = container.querySelectorAll('.member-block');
            const newIndex = blocks.length;
            
            // Clone the first block
            const newBlock = blocks[0].cloneNode(true);
            newBlock.setAttribute('data-index', newIndex);
            
            // Update title
            newBlock.querySelector('.member-title').innerText = `Member ${newIndex + 1}`;
            
            // Clear inputs and update name attributes securely
            const inputs = newBlock.querySelectorAll('input, select');
            inputs.forEach(input => {
                if (input.type !== 'checkbox') input.value = '';
                if (input.type === 'checkbox') input.checked = false;
                
                // Replace the array index in the name attribute (e.g., members[0][full_name] -> members[1][full_name])
                const name = input.getAttribute('name');
                if (name) {
                    input.setAttribute('name', name.replace(/\[\d+\]/, `[${newIndex}]`));
                }
            });

            container.appendChild(newBlock);
        });
    </script>
</body>
</html>