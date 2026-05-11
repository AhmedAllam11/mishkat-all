<!-- Converted from JSX -->
<div class="h-screen flex flex-col items-center justify-center bg-gray-50/50" dir="rtl">
        <div class="w-16 h-16 border-4 border-emerald-100 border-t-emerald-700 rounded-full animate-spin mb-4" />
        <p class="text-emerald-700 font-black animate-pulse">جاري تحميل الحلقات...</p>
      </div>
    );
  }

  return (
    <main class="flex-1 flex flex-col px-4 md:px-8 py-6 bg-gray-50/50" dir="rtl">
      
      <!--  🟢 Header Section  -->
      <div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-4">
        <div class="text-right">
          <h1 class="text-3xl font-black text-gray-900 mb-2">إدارة الحلقات القرآنية</h1>
          <p class="text-gray-500 font-medium">لوحة التحكم المركزية لإدارة حلقاتك ومواعيد البث المباشر</p>
        </div>
        
        <div class="flex gap-3">
          <button 
            onClick={() => window.location.reload(