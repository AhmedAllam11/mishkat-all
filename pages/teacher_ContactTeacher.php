<!-- Converted from JSX -->
<main class="flex-1 flex flex-col px-4 md:px-8 py-6 bg-gray-50/50" dir="rtl">
      
      <!--  🟢 Header Section  -->
      <div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-4">
        <div class="text-right">
          <h1 class="text-3xl font-black text-gray-900 mb-2">السيرة الذاتية والملف الشخصي</h1>
          <p class="text-gray-500 font-medium">إدارة ملفك المهني وسيرتك الذاتية في منصة مشكاة</p>
        </div>
        
        {!isEditing && (
          <button 
            onClick={() => setIsEditing(true