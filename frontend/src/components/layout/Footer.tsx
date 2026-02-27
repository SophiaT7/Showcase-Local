import Link from 'next/link'
import { MapPin } from 'lucide-react'

export default function Footer() {
  return (
    <footer className="bg-gray-900 text-gray-400 mt-auto">
      <div className="max-w-6xl mx-auto px-4 py-10">
        <div className="flex flex-col md:flex-row items-center justify-between gap-4">
          <Link href="/" className="flex items-center gap-2 font-bold text-white text-lg">
            <div className="w-7 h-7 rounded-lg bg-indigo-500 flex items-center justify-center">
              <MapPin className="w-4 h-4 text-white" />
            </div>
            Vitrine<span className="text-indigo-400">Local</span>
          </Link>
          <p className="text-sm text-gray-500">
            © {new Date().getFullYear()} VitrineLocal. Todos os direitos reservados.
          </p>
        </div>
      </div>
    </footer>
  )
}