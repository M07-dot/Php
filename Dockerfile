# استخدم صورة أساسية تحتوي على Ubuntu
FROM ubuntu:20.04

# تثبيت الأدوات الأساسية
RUN apt-get update && apt-get install -y \
  git \
  curl \
  unzip \
  xz-utils \
  zip \
  sudo \
  wget \
  && apt-get clean

# تثبيت Flutter
RUN git clone https://github.com/flutter/flutter.git -b stable /opt/flutter
ENV PATH="$PATH:/opt/flutter/bin"

# تثبيت Dart SDK
RUN apt-get install -y dart

# تثبيت Python و pip
RUN apt-get install -y python3 python3-pip

# تثبيت Flask و Django
RUN pip3 install flask django

# التحقق من التثبيت
RUN flutter doctor
RUN python3 --version
RUN django-admin --version

# أمر لتشغيل التطبيق أو الكود عند بدء الحاوية
CMD ["bash"]
