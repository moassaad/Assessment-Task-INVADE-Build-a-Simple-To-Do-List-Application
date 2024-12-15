const editTaskModal = document.getElementById('editTaskModal');
const editTaskForm = document.getElementById('editTaskForm');
const saveTaskBtn = document.getElementById('saveTaskBtn');

// عند النقر على زر التعديل
document.querySelectorAll('.edit-task-btn').forEach(button => {
  button.addEventListener('click', () => {
    // الحصول على معرف المهمة
    const taskId = button.dataset.taskId;

    // تحميل بيانات المهمة من الخادم وتعبئة النموذج
    // fetch(`/tasks/${taskId}`)
    //   .then(response => response.json())
    //   .then(data => {
    //     // تعبئة حقول النموذج ببيانات المهمة
    //     editTaskForm.querySelector('#taskTitle').value = data.title;
    //     // ... تعبئة باقي الحقول
    //     editTaskModal.classList.add('show');
    //   });
  });
});

// // عند النقر على زر الحفظ
// saveTaskBtn.addEventListener('click', () => {
//   // جمع البيانات من النموذج
//   const formData = new FormData(editTaskForm);

//   // إرسال البيانات إلى الخادم
//   fetch(`/tasks/${taskId}`, {
//     method: 'PUT',
//     body: formData
//   })
//   .then(response => {
//     // تحديث الصفحة أو إعادة تحميل البيانات
//     editTaskModal.classList.remove('show');
//   });
// });