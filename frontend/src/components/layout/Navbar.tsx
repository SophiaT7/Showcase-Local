'use client'
import Link from 'next/link'
import Image from 'next/image'
import { Search, MapPin, Menu, X } from 'lucide-react'
import { useState } from 'react'

export default function Navbar() {
  const [open, setOpen] = useState(false)

  return (
    <header className="sticky top-0 z-50 bg-white border-b border-gray-100 shadow-sm">
      <div className="max-w-6xl mx-auto px-4 h-16 flex items-center justify-between">
        {/* Logo */}
        <Link href="/" className="flex items-center gap-2 font-bold text-xl text-gray-900">
          <Image src="/logoVitrine.png" alt="Vitrine Local" width={36} height={36} />
          <span>Vitrine<span className="text-indigo-600">Local</span></span>
        </Link>

        {/* Desktop nav */}
        <nav className="hidden md:flex items-center gap-6 text-sm text-gray-600">
          <Link href="/" className="hover:text-indigo-600 transition-colors">Explorar</Link>
          <Link href="/categorias" className="hover:text-indigo-600 transition-colors">Categorias</Link>
        </nav>

        {/* Mobile menu button */}
        <button className="md:hidden p-2" onClick={() => setOpen(!open)}>
          {open ? <X className="w-5 h-5" /> : <Menu className="w-5 h-5" />}
        </button>
      </div>

      {/* Mobile menu */}
      {open && (
        <div className="md:hidden border-t bg-white px-4 py-4 flex flex-col gap-3 text-sm text-gray-700">
          <Link href="/" onClick={() => setOpen(false)}>Explorar</Link>
          <Link href="/categorias" onClick={() => setOpen(false)}>Categorias</Link>
        </div>
      )}
    </header>
  )
}